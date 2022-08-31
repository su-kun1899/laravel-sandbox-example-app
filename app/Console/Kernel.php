<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('sample-command')->everyMinute()->emailOutputTo('info@example.com');
//         $schedule->command('sample-command')->hourly();
//         $schedule->command('sample-command')->hourlyAt(8);
//         $schedule->command('sample-command')->daily();
//         $schedule->command('sample-command')->dailyAt('13:00');
//         $schedule->command('sample-command')->cron('15 3 * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
