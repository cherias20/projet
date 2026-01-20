<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\Penalty;
use App\Models\Parameter;
use Carbon\Carbon;

class PenaltyService
{
    /**
     * Vérifie et crée les pénalités pour les emprunts en retard
     */
    public static function checkAndCreatePenalties()
    {
        // Récupérer le taux de pénalité depuis les paramètres
        $dailyRate = Parameter::where('clé', 'penalty_daily_rate')
            ->first()
            ?->valeur ?? 1.50; // 1.50 euros par jour par défaut

        // Récupérer tous les emprunts en retard sans pénalité créée
        $overdueLoans = Loan::where('statut', 'en_cours')
            ->where('date_retour_prevue', '<', now())
            ->with('penalites')
            ->get()
            ->filter(function ($loan) {
                // On crée une pénalité seulement s'il n'y en a pas déjà
                return $loan->penalites()->where('statut', 'non_payee')->count() === 0;
            });

        $createdPenalties = 0;

        foreach ($overdueLoans as $loan) {
            $daysOverdue = Carbon::parse($loan->date_retour_prevue)->diffInDays(now());
            $amount = $daysOverdue * $dailyRate;

            Penalty::create([
                'montant' => $amount,
                'date_calcul' => now()->toDateString(),
                'raison' => "Retard de {$daysOverdue} jour(s) sur l'emprunt #{$loan->id_emprunt}",
                'statut' => 'non_payee',
                'id_membre' => $loan->id_membre,
                'id_emprunt' => $loan->id_emprunt,
            ]);

            $createdPenalties++;
        }

        return $createdPenalties;
    }

    /**
     * Bloque les comptes des membres avec pénalités non payées
     */
    public static function blockMembersWithUnpaidPenalties()
    {
        $membres = \App\Models\Membre::with('penalites')
            ->where('statut', 'actif')
            ->get()
            ->filter(function ($membre) {
                return $membre->penalites()
                    ->where('statut', 'non_payee')
                    ->count() > 0;
            });

        $blockedCount = 0;

        foreach ($membres as $membre) {
            $totalUnpaid = $membre->penalites()
                ->where('statut', 'non_payee')
                ->sum('montant');

            // Si le montant total dépasse un seuil (ex: 30 euros)
            if ($totalUnpaid >= 30) {
                $membre->statut = 'bloqué';
                $membre->save();
                $blockedCount++;
            }
        }

        return $blockedCount;
    }

    /**
     * Déverrouille un membre une fois ses pénalités payées
     */
    public static function unlockMemberIfPaid(\App\Models\Membre $membre)
    {
        $unpaidPenalties = $membre->penalites()
            ->where('statut', 'non_payee')
            ->count();

        if ($unpaidPenalties === 0) {
            $membre->statut = 'actif';
            $membre->save();
            return true;
        }

        return false;
    }

    /**
     * Marquer une pénalité comme payée
     */
    public static function markAsPaid(Penalty $penalty)
    {
        $penalty->markAsPaid();

        // Vérifier si toutes les pénalités du membre sont payées
        self::unlockMemberIfPaid($penalty->membre);

        return $penalty;
    }

    /**
     * Obtenir le montant total des pénalités non payées d'un membre
     */
    public static function getTotalUnpaidPenalties(\App\Models\Membre $membre)
    {
        return $membre->penalites()
            ->where('statut', 'non_payee')
            ->sum('montant');
    }
}
