<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Health\Commands\RunHealthChecksCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $customSchedulerPath = app_path('Console/CustomScheduler.php');

        if (file_exists($customSchedulerPath)) {
            require_once $customSchedulerPath;
            CustomScheduler::scheduleTasks($schedule);
        }
        $schedule->command('send:task-reminder-emails')->dailyAt('08:00');
        $schedule->command('app:check-coingate-command')->everyFiveMinutes();

        $schedule->command('app:check-razorpay-command')->everyFiveMinutes();

        $schedule->command('subscription:check-end')->everyFiveMinutes();

        $schedule->command('app:check-yookassa-command')->daily();
        $schedule->command('cleanup:business')->dailyAt('01:34')->when(function () {
            return Carbon::now()->format('Y-m-d') === Carbon::parse('2025-05-15')->addDays(30)->format('Y-m-d');
        });
    }
protected $commands = [
     \App\Console\Commands\CleanupBusinessData::class,
];
    // $schedule->command(RunHealthChecksCommand::class)->everyFiveMinutes();
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
