<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Loan;
use App\Models\Exemplaire;
use App\Models\Penalty;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        // Vue membre - emprunts du membre connecté via session
        if (session()->has('membre_id') && session()->get('membre_role') !== 'admin') {
            $memberId = session()->get('membre_id');
            $loans = Loan::where('id_membre', $memberId)
                ->with('exemplaire.book', 'membre', 'penalites')
                ->orderBy('date_emprunt', 'desc')
                ->paginate(20);
        } else {
            $loans = collect();
        }
        
        return view('loans.index', compact('loans'));
    }

    public function adminIndex()
    {
        // Vue admin - tous les emprunts
        $loans = Loan::with(['membre', 'exemplaire.book'])
            ->orderBy('date_emprunt', 'desc')
            ->paginate(20);
        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load(['membre', 'exemplaire.book']);
        
        // Afficher la vue admin ou membre selon le rôle
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.loans.show', compact('loan'));
        }
        return view('loans.show', compact('loan'));
    }

    public function quickBorrow(Request $request)
    {
        // Mode membre (connexion par session)
        if (!session()->has('membre_id') || session()->get('membre_role') === 'admin') {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour emprunter un livre.');
        }

        $book_id = $request->query('book_id');
        $memberId = session()->get('membre_id');

        // Vérifier que le livre existe et a un exemplaire disponible
        $exemplaire = Exemplaire::with('book')
            ->where('id_livre', $book_id)
            ->where('statut', 'disponible')
            ->first();

        if (!$exemplaire) {
            return back()->with('error', 'Aucun exemplaire disponible pour ce livre.');
        }

        // Créer l'emprunt immédiatement
        $dateEmprunt = now()->format('Y-m-d');
        $dateRetourPrevue = now()->addMonth()->format('Y-m-d');

        try {
            $loan = Loan::create([
                'date_emprunt' => $dateEmprunt,
                'date_retour_prevue' => $dateRetourPrevue,
                'statut' => 'en_cours',
                'nombre_renouvellement' => 0,
                'renouvellement_max' => 3,
                'id_membre' => $memberId,
                'id_exemple' => $exemplaire->id_exemple,
            ]);

            // Marquer l'exemplaire comme emprunté
            $exemplaire->statut = 'emprunté';
            $exemplaire->save();

            return redirect()->route('admin.loans.index')
                ->with('success', 'Livre "' . $exemplaire->book->titre . '" emprunté avec succès jusqu\'au ' . date('d/m/Y', strtotime($dateRetourPrevue)) . ' !');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur s\'est produite lors de l\'emprunt: ' . $e->getMessage());
        }
    }

    public function create(Request $request)
    {
        $book_id = $request->query('book_id');
        
        // Si c'est un utilisateur connecté (membre) et pas admin
        if (session()->has('membre_id') && session()->get('membre_role') !== 'admin') {
            // Récupérer les exemplaires disponibles du livre spécifié
            if ($book_id) {
                $exemplaires = Exemplaire::with('book')
                    ->where('id_livre', $book_id)
                    ->where('statut', 'disponible')
                    ->get();
                if ($exemplaires->isEmpty()) {
                    return redirect()->route('books.index')->with('error', 'Aucun exemplaire disponible pour ce livre.');
                }
                return view('loans.create', compact('exemplaires', 'book_id'));
            }
            // Sinon, afficher tous les exemplaires disponibles
            $exemplaires = Exemplaire::with('book')
                ->where('statut', 'disponible')
                ->get();
            return view('loans.create', compact('exemplaires'));
        }
        
        // Vue admin
        $membres = Membre::where('statut', 'actif')->get();
        if ($book_id) {
            $exemplaires = Exemplaire::with('book')
                ->where('id_livre', $book_id)
                ->where('statut', 'disponible')
                ->get();
        } else {
            $exemplaires = Exemplaire::with('book')
                ->where('statut', 'disponible')
                ->get();
        }
        return view('admin.loans.create', compact('membres', 'exemplaires', 'book_id'));
    }

    public function store(Request $request)
    {
        // Mode membre (connexion par session)
        if (session()->has('membre_id') && session()->get('membre_role') !== 'admin') {
            $validated = $request->validate([
                'book_id' => 'required|exists:books,id_livre',
                'quantity' => 'required|integer|min:1|max:5',
                'date_emprunt' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            ], [
                'book_id.required' => 'Le livre est obligatoire',
                'book_id.exists' => 'Le livre sélectionné n\'existe pas',
                'quantity.required' => 'La quantité est obligatoire',
                'quantity.integer' => 'La quantité doit être un nombre entier',
                'quantity.min' => 'Vous devez emprunter au moins 1 livre',
                'quantity.max' => 'Vous ne pouvez pas emprunter plus de 5 livres à la fois',
                'date_emprunt.required' => 'La date d\'emprunt est obligatoire',
                'date_emprunt.date' => 'La date doit être valide',
                'date_emprunt.after_or_equal' => 'La date d\'emprunt ne peut pas être dans le passé',
            ]);

            $book_id = $validated['book_id'];
            $quantity = $validated['quantity'];
            $dateEmprunt = $validated['date_emprunt'];
            $memberId = session()->get('membre_id');

            // Vérifier qu'il y a assez d'exemplaires disponibles pour ce livre
            $availableExemplaires = Exemplaire::with('book')
                ->where('id_livre', $book_id)
                ->where('statut', 'disponible')
                ->limit($quantity)
                ->get();

            if ($availableExemplaires->count() < $quantity) {
                return back()->with('error', 'Il n\'y a que ' . $availableExemplaires->count() . ' exemplaire(s) disponible(s) au lieu de ' . $quantity . ' demandé(s).');
            }

            // Calculer la date de retour (1 mois après la date d'emprunt choisie)
            $dateRetourPrevue = \Carbon\Carbon::createFromFormat('Y-m-d', $dateEmprunt)->addMonth()->format('Y-m-d');

            // Créer les emprunts pour chaque exemplaire
            $createdLoans = 0;
            $bookTitle = $availableExemplaires->first()->book->titre ?? 'Titre inconnu';
            
            foreach ($availableExemplaires as $exemplaire) {
                Loan::create([
                    'date_emprunt' => $dateEmprunt,
                    'date_retour_prevue' => $dateRetourPrevue,
                    'statut' => 'en_cours',
                    'nombre_renouvellement' => 0,
                    'renouvellement_max' => 3,
                    'id_membre' => $memberId,
                    'id_exemple' => $exemplaire->id_exemple,
                ]);

                // Marquer l'exemplaire comme emprunté
                $exemplaire->statut = 'emprunté';
                $exemplaire->save();

                $createdLoans++;
            }

            return redirect()->route('admin.loans.index')
                ->with('success', $createdLoans . ' exemplaire(s) de "' . $bookTitle . '" emprunté(s) avec succès ! Retour prévu le ' . date('d/m/Y', strtotime($dateRetourPrevue)));
        }

        // Mode admin
        $validated = $request->validate([
            'id_membre' => 'required|exists:membres,id_membre',
            'id_exemple' => 'required|exists:exemplaires,id_exemple',
            'renouvellement_max' => 'nullable|integer|min:1|max:10',
        ]);

        $membre = Membre::findOrFail($validated['id_membre']);
        $exemplaire = Exemplaire::findOrFail($validated['id_exemple']);

        // Vérifications
        if ($membre->statut !== 'actif') {
            return back()->withErrors(['id_membre' => 'Le membre n\'est pas actif.']);
        }

        if ($exemplaire->statut !== 'disponible') {
            return back()->withErrors(['id_exemple' => 'Cet exemplaire n\'est pas disponible.']);
        }

        // Créer l'emprunt
        $loan = Loan::create([
            'date_emprunt' => now()->toDateString(),
            'date_retour_prevue' => now()->addMonth()->toDateString(),
            'statut' => 'en_cours',
            'nombre_renouvellement' => 0,
            'renouvellement_max' => $validated['renouvellement_max'] ?? 3,
            'id_membre' => $validated['id_membre'],
            'id_exemple' => $validated['id_exemple'],
        ]);

        // Mettre à jour l'exemplaire
        $exemplaire->statut = 'emprunté';
        $exemplaire->save();

        return redirect()->route('admin.loans.index')
            ->with('success', 'Emprunt enregistré avec succès.');
    }

    public function renewLoan(Loan $loan)
    {
        if ($loan->renew()) {
            return back()->with('success', 'Emprunt renouvelé avec succès.');
        }
        return back()->withErrors('Impossible de renouveler cet emprunt.');
    }

    public function returnBook(Loan $loan)
    {
        if ($loan->statut !== 'en_cours') {
            return back()->withErrors('Cet emprunt est déjà clôturé.');
        }

        $loan->returnBook();

        // Vérifier s'il y a un retard et créer une pénalité si nécessaire
        if ($loan->statut === 'retard') {
            Penalty::createFromOverdueLoan($loan);
        }

        return redirect()->route('admin.loans.index')
            ->with('success', 'Livre retourné avec succès');
    }

    public function getOverdueLoans()
    {
        $loans = Loan::where('statut', 'en_cours')
            ->where('date_retour_prevue', '<', now())
            ->with(['membre', 'exemplaire.book'])
            ->orderBy('date_retour_prevue')
            ->paginate(20);

        return view('loans.overdue', compact('loans'));
    }

    public function memberLoans(Membre $membre)
    {
        $activeLoans = $membre->emprunts()
            ->where('statut', 'en_cours')
            ->with('exemplaire.book')
            ->get();

        $pastLoans = $membre->emprunts()
            ->whereIn('statut', ['termine', 'retard'])
            ->with('exemplaire.book')
            ->latest()
            ->paginate(10);

        return view('loans.member', compact('membre', 'activeLoans', 'pastLoans'));
    }

    public function destroy(Loan $loan)
    {
        // Vérification que l'utilisateur peut supprimer cet emprunt
        // Admin peut supprimer n'importe quel emprunt
        // Un membre peut seulement supprimer ses propres emprunts
        if (session()->get('membre_role') !== 'admin' && session()->get('membre_id') != $loan->id_membre) {
            return redirect()->route('admin.loans.index')->with('error', 'Vous n\'avez pas la permission de supprimer cet emprunt.');
        }

        try {
            $loanId = $loan->id_emprunt;
            $bookTitle = $loan->exemplaire->book->titre ?? 'Livre inconnu';
            
            // Supprimer l'emprunt de la base de données
            $loan->delete();
            
            \Log::info('Emprunt supprimé avec succès', ['id_emprunt' => $loanId, 'user' => session()->get('membre_id')]);
            
            return redirect()->route('admin.loans.index')
                ->with('success', 'L\'emprunt de "' . $bookTitle . '" a été supprimé avec succès de la base de données.');
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la suppression d\'un emprunt', ['error' => $e->getMessage()]);
            return redirect()->route('admin.loans.index')
                ->with('error', 'Une erreur s\'est produite lors de la suppression de l\'emprunt: ' . $e->getMessage());
        }
    }
}