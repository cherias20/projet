<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\Penalty;
use App\Models\Exemplaire;
use App\Models\Reservation;
use App\Models\Parameter;
use Carbon\Carbon;

class LibraryService
{
    /**
     * Créer un nouvel emprunt
     */
    public function createLoan($memberId, $exemplaires_id)
    {
        $exemplaire = Exemplaire::find($exemplaires_id);
        
        if (!$exemplaire || $exemplaire->statut !== 'disponible') {
            throw new \Exception('Exemplaire non disponible');
        }

        $loan = Loan::create([
            'date_emprunt' => now()->toDateString(),
            'date_retour_prevue' => now()->addDays(
                (int)Parameter::get('loan_duration_days', 14)
            )->toDateString(),
            'statut' => 'en_cours',
            'nombre_renouvellement' => 0,
            'renouvellement_max' => (int)Parameter::get('max_renewals', 3),
            'id_membre' => $memberId,
            'id_exemple' => $exemplaires_id,
        ]);

        $exemplaire->update(['statut' => 'emprunté']);

        return $loan;
    }

    /**
     * Retourner un livre et gérer les pénalités
     */
    public function returnLoan(Loan $loan)
    {
        if ($loan->statut !== 'en_cours') {
            throw new \Exception('Cet emprunt ne peut pas être retourné');
        }

        $loan->date_retour = now()->toDateString();

        if ($loan->isOverdue()) {
            $loan->statut = 'retard';
            
            // Créer une pénalité
            $daysOverdue = $loan->getDaysOverdue();
            $dailyRate = (float)Parameter::get('daily_penalty_rate', 1.50);
            $amount = $daysOverdue * $dailyRate;

            Penalty::create([
                'montant' => $amount,
                'date_calcul' => now()->toDateString(),
                'raison' => "Retard de {$daysOverdue} jour(s)",
                'statut' => 'non_payee',
                'id_membre' => $loan->id_membre,
                'id_emprunt' => $loan->id_emprunt,
            ]);
        } else {
            $loan->statut = 'termine';
        }

        $loan->save();

        // Rendre l'exemplaire disponible
        $loan->exemplaire->update(['statut' => 'disponible']);

        // Vérifier s'il y a des réservations
        $this->checkReservations($loan->exemplaire->id_livre);

        return $loan;
    }

    /**
     * Renouveler un emprunt
     */
    public function renewLoan(Loan $loan)
    {
        if (!$loan->canRenew()) {
            throw new \Exception('Impossible de renouveler cet emprunt');
        }

        $loan->renew();
        return $loan;
    }

    /**
     * Créer une réservation
     */
    public function createReservation($memberId, $bookId)
    {
        $existingReservation = Reservation::where('id_membre', $memberId)
            ->where('id_livre', $bookId)
            ->where('statut', '!=', 'annulee')
            ->first();

        if ($existingReservation) {
            throw new \Exception('Réservation déjà existante pour ce livre');
        }

        $position = Reservation::where('id_livre', $bookId)
            ->where('statut', 'en_attente')
            ->max('position') + 1;

        $reservation = Reservation::create([
            'date_reservation' => now()->toDateString(),
            'statut' => 'en_attente',
            'position' => $position,
            'id_membre' => $memberId,
            'id_livre' => $bookId,
        ]);

        return $reservation;
    }

    /**
     * Vérifier et notifier les réservations
     */
    public function checkReservations($bookId)
    {
        $availableCopies = Exemplaire::where('id_livre', $bookId)
            ->where('statut', 'disponible')
            ->count();

        if ($availableCopies > 0) {
            $nextReservation = Reservation::where('id_livre', $bookId)
                ->where('statut', 'en_attente')
                ->orderBy('position')
                ->first();

            if ($nextReservation) {
                $nextReservation->update([
                    'statut' => 'disponible',
                    'notifier' => true,
                ]);

                // Vous pourriez ajouter une notification par email ici
                // Mail::to($nextReservation->membre->email)
                //     ->send(new ReservationAvailable($nextReservation));
            }
        }
    }

    /**
     * Générer les pénalités pour tous les emprunts en retard
     */
    public function generatePendingPenalties()
    {
        $overdueLoans = Loan::where('statut', 'en_cours')
            ->where('date_retour_prevue', '<', now())
            ->get();

        $count = 0;
        foreach ($overdueLoans as $loan) {
            // Vérifier si une pénalité n'existe pas déjà
            $existingPenalty = Penalty::where('id_emprunt', $loan->id_emprunt)
                ->where('statut', 'non_payee')
                ->first();

            if (!$existingPenalty) {
                Penalty::createFromOverdueLoan($loan);
                $count++;
            }
        }

        return $count;
    }

    /**
     * Obtenir les statistiques de la bibliothèque
     */
    public function getStatistics()
    {
        return [
            'total_books' => \App\Models\Book::count(),
            'total_exemplaires' => Exemplaire::count(),
            'total_members' => \App\Models\Membre::count(),
            'active_members' => \App\Models\Membre::where('statut', 'actif')->count(),
            'active_loans' => Loan::where('statut', 'en_cours')->count(),
            'overdue_loans' => Loan::where('statut', 'en_cours')
                ->where('date_retour_prevue', '<', now())
                ->count(),
            'total_reservations' => Reservation::where('statut', '!=', 'annulee')->count(),
            'total_penalties' => Penalty::sum('montant'),
            'unpaid_penalties' => Penalty::where('statut', 'non_payee')->sum('montant'),
            'available_copies' => Exemplaire::where('statut', 'disponible')->count(),
        ];
    }

    /**
     * Vérifier la disponibilité d'un livre
     */
    public function getBookAvailability($bookId)
    {
        $total = Exemplaire::where('id_livre', $bookId)->count();
        $available = Exemplaire::where('id_livre', $bookId)
            ->where('statut', 'disponible')
            ->count();
        $borrowed = Loan::whereHas('exemplaire', function ($q) use ($bookId) {
            $q->where('id_livre', $bookId);
        })->where('statut', 'en_cours')->count();

        return [
            'total' => $total,
            'available' => $available,
            'borrowed' => $borrowed,
            'unavailable' => $total - $available,
        ];
    }
}
