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
        // Vue membre - emprunts du membre connecté
        if (auth()->check()) {
            $membre = auth()->user()->membre;
            $loans = $membre->emprunts()
                ->with('exemplaire.book')
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

    public function create()
    {
        $membres = Membre::where('statut', 'actif')->get();
        $exemplaires = Exemplaire::with('book')
            ->where('statut', 'disponible')
            ->get();
        return view('admin.loans.create', compact('membres', 'exemplaires'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_membre' => 'required|exists:membres,id_membre',
            'id_exemple' => 'required|exists:exemplaires,id_exemple',
            'renouvellement_max' => 'nullable|integer|min:1|max:10',
        ]);

        $membre = Membre::findOrFail($validated['id_membre']);
        $exemplaire = Exemplaire::findOrFail($validated['id_exemple']);

        // Vérifications
        if (!$membre->isActive()) {
            return back()->withErrors(['id_membre' => 'Le membre n\'est pas actif.']);
        }

        if ($exemplaire->statut !== 'disponible') {
            return back()->withErrors(['id_exemple' => 'Cet exemplaire n\'est pas disponible.']);
        }

        // Créer l'emprunt
        $loan = Loan::create([
            'date_emprunt' => now()->toDateString(),
            'date_retour_prevue' => now()->addDays(14)->toDateString(),
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
}
