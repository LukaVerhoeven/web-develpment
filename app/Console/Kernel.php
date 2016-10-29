<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Wedstrijddate;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('inspire')
        //          ->hourly();
        $path = "App\Console\Commands\error.txt";
        $schedule->command('Wincontest')->everyMinute()->sendOutputTo($path);

        $schedule->call(function () {
            $yesterday = strtotime("-24 hours");
            $yesterdaydate = date('Y-m-d', $yesterday);
            $nowdate = $now->format('Y-m-d');
            $Endcontest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->exists();


            if ($Endcontest) {
                $contest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->first();
                // less than 12 hours ago
                // mail a winner
                $this->line('Display this on the screen');

            }
            else {
                // more than 12 hours ago
            }
        })->dailyAt('00:01');

        $schedule->command('Wincontest')->dailyAt('00:01');
    }
}
