<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Vérifier les emprunts en retard et créer les pénalités automatiquement
        // Exécuté quotidiennement à minuit
        $schedule->command('loans:check-overdue')
            ->daily()
            ->at('00:00')
            ->withoutOverlapping()
            ->onSuccess(function () {
                Log::info('Vérification des emprunts en retard effectuée avec succès');
            })
            ->onFailure(function () {
                Log::error('Erreur lors de la vérification des emprunts en retard');
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
