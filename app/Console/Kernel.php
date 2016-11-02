<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Wedstrijddate;
use App\Vote;
use DB;
use Carbon\Carbon;
use Mail;

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


        $schedule->call(function () {

            $now = Carbon::now();
            $yesterday = strtotime("-24 hours");
            $yesterdaydate = date('Y-m-d', $yesterday);
            $nowdate = $now->format('Y-m-d');
            $Endcontest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->exists();


            if ($Endcontest) {
                $contest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->first();
                $topvoted = Vote::select('photo_id', DB::raw('COUNT(photo_id) as votes'),'photos.contestimage', 'photos.isdeleted','wedstrijddates.price', 'photos.wedstrijd_id', 'users.name' ,'users.email' )
                ->leftJoin('photos', 'photo_id', '=', 'photos.id')
                ->leftJoin('users', 'photos.user_id', '=', 'users.id')
                ->leftJoin('wedstrijddates', 'photos.wedstrijd_id', '=', 'wedstrijddates.id')
                ->groupBy('photo_id')
                ->orderBy('votes', 'desc')
                ->where('isdeleted',0)
                ->where('photos.wedstrijd_id',$contest->id )
                ->first();
                // mail a winner
                $affected = DB::table('wedstrijddates')->where('lastended', '=', 1)->update(array('lastended' => 0));
                $contest->lastended = 1;
                if (!empty($topvoted)) {
                $contest->won = $topvoted->name;
                $contest->save();
                $data = [
                  'title'=>'U heeft Gewonnen',
                  'user'=> $topvoted->name,
                  'img' => substr($topvoted->contestimage, 5),
                  'price'=> $topvoted->price,
                  'e-mail' =>$topvoted->email,
                  'content'=>'U heeft de hoofdprijs gewonnen:'
                ];
                Mail::send('auth.emails.wincontest',$data, function ($message) use ($data) {

                      $message->to($data['e-mail'], $data['user'])->subject('Your won!');
                });
              }else {
                  $contest->save();
              }
            }

        })->dailyAt('00:01');

        // $schedule->command('Wincontest')->everyMinute();
    }
}
