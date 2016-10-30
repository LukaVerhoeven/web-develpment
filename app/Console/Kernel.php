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
                $topvoted = Vote::select('photo_id', DB::raw('COUNT(photo_id) as votes'),'photos.contestimage', 'photos.wedstrijd_id', 'users.name' )
                ->leftJoin('photos', 'photo_id', '=', 'photos.id')
                ->leftJoin('users', 'photos.user_id', '=', 'users.id')
                ->groupBy('photo_id')
                ->orderBy('votes', 'desc')
                ->where('photos.wedstrijd_id',$contest->id )
                ->take(10)
                ->get();
                // less than 12 hours ago
                // mail a winner
                $data = [
                  'title'=>'U heeft Gewonnen',
                  'user'=> $topvoted->name,
                  'img' =>$topvoted->contestimage,
                  'content'=>'U heeft de hoofdprijs gewonnen met deze foto'
                ];
                Mail::send('auth.emails.wincontest',$data, function ($message) {

                      $message->to("lka.v.lv@gmail.com", "luka")->subject('Your Reminder!');
                });

            }

        })->dailyAt('00:01');

        $schedule->command('Wincontest')->dailyAt('00:01');
    }
}
