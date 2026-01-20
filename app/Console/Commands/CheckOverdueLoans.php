<?php

namespace App\Console\Commands;

use App\Services\PenaltyService;
use Illuminate\Console\Command;

class CheckOverdueLoans extends Command
{
    protected $signature = 'loans:check-overdue';
    protected $description = 'Vérifie les emprunts en retard et crée les pénalités associées';

    public function handle()
    {
        $this->info('Vérification des emprunts en retard...');

        $createdPenalties = PenaltyService::checkAndCreatePenalties();
        $blockedMembers = PenaltyService::blockMembersWithUnpaidPenalties();

        $this->info("✓ {$createdPenalties} pénalité(s) créée(s)");
        $this->info("✓ {$blockedMembers} compte(s) bloqué(s)");
        $this->info('Vérification terminée !');
    }
}
