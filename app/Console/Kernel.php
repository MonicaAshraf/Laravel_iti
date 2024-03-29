<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Post;
use Carbon\Carbon;
use App\Jobs\PruneOldPostsJob;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // $schedule->call(function () {
        //     $dateOldertwoYears=Carbon::now()->subYears(2)->toDateTimeString();
        //     $oldPosts=Post::where('created_at','<=',$dateOldertwoYears)->delete();
        // })->daily();

        $schedule->job(new PruneOldPostsJob)->dailyAt('12:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
