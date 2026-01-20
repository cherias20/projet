<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Book;
use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index()
    {
        // Vue membre - réservations du membre connecté via session
        if (session()->has('membre_id') && session()->get('membre_role') !== 'admin') {
            $memberId = session()->get('membre_id');
            $reservations = Reservation::where('id_membre', $memberId)
                ->with('book', 'membre')
                ->orderBy('position')
                ->paginate(20);
        } else {
            $reservations = collect();
        }
        
        return view('reservations.index', compact('reservations'));
    }

    public function adminIndex()
    {
        // Vue admin - toutes les réservations
        $reservations = Reservation::with(['membre', 'book'])
            ->orderBy('position')
            ->paginate(20);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['membre', 'book']);
        
        // Afficher la vue admin ou membre selon le rôle
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.reservations.show', compact('reservation'));
        }
        return view('reservations.show', compact('reservation'));
    }

    public function create(Request $request)
    {
        $book_id = $request->query('book_id');
        
        // Si c'est un utilisateur connecté (membre) et pas admin
        if (session()->has('membre_id') && session()->get('membre_role') !== 'admin') {
            // Si un book_id est fourni, afficher seulement ce livre
            if ($book_id) {
                $book = Book::with(['exemplaires', 'authors', 'genres'])->find($book_id);
                if (!$book) {
                    return redirect()->route('books.index')->with('error', 'Livre non trouvé.');
                }
                return view('reservations.create', compact('book'));
            }
            // Sinon, afficher tous les livres pour les réservations
            $books = Book::with(['exemplaires', 'authors', 'genres'])->get();
            return view('reservations.create', compact('books'));
        }
        
        // Vue admin
        if ($book_id) {
            $books = Book::with('exemplaires')->where('id_livre', $book_id)->get();
        } else {
            $books = Book::with('exemplaires')->get();
        }
        $membres = Membre::where('statut', 'actif')->get();
        return view('admin.reservations.create', compact('books', 'membres', 'book_id'));
    }

    public function store(Request $request)
    {
        try {
            // Vérifier si l'utilisateur est membre (pas admin)
            if (!session()->has('membre_id') || session()->get('membre_role') === 'admin') {
                return redirect()->route('login')->with('error', 'Vous devez être connecté en tant que membre pour réserver un livre.');
            }

            // Validation des données
            $validated = $request->validate([
                'book_id' => 'required|integer|exists:books,id_livre',
                'quantity' => 'sometimes|integer|min:1|max:5',
            ], [
                'book_id.required' => 'Le livre est obligatoire',
                'book_id.integer' => 'L\'ID du livre doit être un nombre entier',
                'book_id.exists' => 'Le livre sélectionné n\'existe pas',
                'quantity.integer' => 'La quantité doit être un nombre entier',
                'quantity.min' => 'Vous devez réserver au moins 1 exemplaire',
                'quantity.max' => 'Vous ne pouvez réserver que 5 exemplaires maximum',
            ]);

            $memberId = session()->get('membre_id');
            $bookId = $validated['book_id'];
            $quantity = $validated['quantity'] ?? 1;
            
            // Vérifier si le livre existe
            $book = Book::with('exemplaires')->find($bookId);
            if (!$book) {
                return back()->with('error', 'Le livre sélectionné n\'existe pas.');
            }

            // Vérifier si le livre a des exemplaires disponibles
            if ($book->exemplaires->where('statut', 'disponible')->count() == 0) {
                return back()->with('error', 'Ce livre n\'a pas d\'exemplaires disponibles à réserver.');
            }

            // Vérifier si le membre n'a pas déjà réservé ce livre
            $existingReservation = Reservation::where('id_membre', $memberId)
                ->where('id_livre', $bookId)
                ->first();
            
            if ($existingReservation) {
                return back()->with('error', 'Vous avez déjà réservé ce livre.');
            }

            // Créer les réservations selon la quantité
            for ($i = 0; $i < $quantity; $i++) {
                $position = Reservation::where('id_livre', $bookId)->max('position') + 1;

                Reservation::create([
                    'id_membre' => $memberId,
                    'id_livre' => $bookId,
                    'position' => $position,
                    'date_reservation' => now(),
                    'statut' => 'en_attente',
                ]);
            }

            $quantityText = $quantity > 1 ? $quantity . ' réservations' : '1 réservation';
            return redirect()->route('reservations.index')
                ->with('success', $quantityText . ' créée(s) avec succès pour "' . $book->titre . '"');
                
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de réservation: ' . $e->getMessage());
            return back()->with('error', 'Une erreur s\'est produite lors de la création de la réservation: ' . $e->getMessage());
        }
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->statut === 'annulee') {
            return back()->withErrors('Cette réservation est déjà annulée.');
        }

        $reservation->cancel();

        return back()->with('success', 'Réservation annulée avec succès.');
    }

    public function checkAvailability(Reservation $reservation)
    {
        if ($reservation->checkAvailability()) {
            return back()->with('success', 'Un exemplaire est disponible ! Notification envoyée au membre.');
        }
        return back()->with('info', 'Aucun exemplaire disponible pour le moment.');
    }

    public function memberReservations(Membre $membre)
    {
        $reservations = $membre->reservations()
            ->with('book')
            ->orderBy('position')
            ->paginate(15);

        return view('reservations.member', compact('membre', 'reservations'));
    }

    public function bookReservations(Book $book)
    {
        $reservations = $book->reservations()
            ->with('membre')
            ->where('statut', '!=', 'annulee')
            ->orderBy('position')
            ->paginate(15);

        return view('reservations.book', compact('book', 'reservations'));
    }
}
