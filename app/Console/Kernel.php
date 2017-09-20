<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Recommendation;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SetReviewMedian::class,
        Commands\RefreshUserScores::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('set:review-median')
            ->everyFiveMinutes();

        $schedule->command('refresh:user-scores')
            ->everyTenMinutes();

        $schedule->call(function () {
            $tags = \App\Tag::all();

            foreach ($tags as $tag) {
                $tag->cafe_tag_count = $tag->cafeTags->count();

                $tag->save();
            }
        })->everyMinute();
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
