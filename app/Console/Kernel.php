<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // * * * * * cd /home/gabriel/PhpstormProjects/sistema-estoque-norven && php artisan schedule:run >> /dev/null 2>&1
        $schedule->command('app:verificar-produtos')->everyMinute()
            ->appendOutputTo(storage_path('logs/command.log'));
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
