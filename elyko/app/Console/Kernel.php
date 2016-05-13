<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\Migration',
        'App\Console\Commands\Clean',
        'App\Console\Commands\MigrationLocal'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Every 6 hours
        $schedule->command('migration')->cron('0 */6 * * *');
        // Every year
        $schedule->command('clean')->cron('0 0 1 9 *');
    }
}
