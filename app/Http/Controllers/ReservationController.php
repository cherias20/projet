<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Book;
use App\Models\Membre;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['membre', 'book'])
            ->orderBy('position')
            ->paginate(20);
        return view('reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['membre', 'book.exemplaires']);
        return view('reservations.show', compact('reservation'));
    }

    public function create()
    {
        $books = Book::with('exemplaires')->get();
        $membres = Membre::where('statut', 'actif')->get();
        return view('reservations.create', compact('books', 'membres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_livre' => 'required|exists:books,id_livre',
            'id_membre' => 'required|exists:membres,id_membre',
        ]);

        $book = Book::findOrFail($validated['id_livre']);
        $membre = Membre::findOrFail($validated['id_membre']);

        // Vérifications
        if (!$membre->isActive()) {
            return back()->withErrors(['id_membre' => 'Le membre n\'est pas actif.']);
        }

        // Vérifier si une réservation identique existe déjà
        $existing = Reservation::where('id_livre', $validated['id_livre'])
            ->where('id_membre', $validated['id_membre'])
            ->where('statut', '!=', 'annulee')
            ->first();

        if ($existing) {
            return back()->withErrors('Ce membre a déjà une réservation pour ce livre.');
        }

        // Calculer la position
        $position = Reservation::where('id_livre', $validated['id_livre'])
            ->where('statut', 'en_attente')
            ->max('position') + 1;

        // Vérifier la disponibilité
        $status = $book->getAvailableCopiesCount() > 0 ? 'disponible' : 'en_attente';

        $reservation = Reservation::create([
            'date_reservation' => now()->toDateString(),
            'statut' => $status,
            'position' => $position,
            'id_livre' => $validated['id_livre'],
            'id_membre' => $validated['id_membre'],
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Réservation créée avec succès.');
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
