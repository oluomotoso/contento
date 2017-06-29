<?php

namespace App\Console;

use App\Console\Commands\AutopublishContents;
use App\Console\Commands\FetchFeeds;
use App\Console\Commands\RemoveOldIndex;
use App\Console\Commands\RemoveOldJobIndex;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FetchFeeds::class,
        AutopublishContents::class,
        RemoveOldIndex::class,
        RemoveOldJobIndex::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fetch:feeds')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('autopublish:contents')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('remove:oldindex')->everyThirtyMinutes()->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
