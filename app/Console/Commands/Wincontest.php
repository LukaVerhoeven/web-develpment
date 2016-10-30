<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wedstrijddate;

class Wincontest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Wincontest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks for winner when contest ends';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $yesterday = strtotime("-24 hours");
      $yesterdaydate = date('Y-m-d', $yesterday);
      $nowdate = $now->format('Y-m-d');
      $Endcontest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->exists();


      if ($Endcontest) {
          $contest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->first();
          $topvoted = Vote::select('photo_id', DB::raw('COUNT(photo_id) as votes'), 'photos.wedstrijd_id', 'users.name' )
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
            'title'=>'hallo',
            'content'=>'jij bent cool'
          ];
          Mail::send('auth.emails.wincontest',$data, function ($message) {

                $message->to("lka.v.lv@gmail.com", "luka")->subject('Your Reminder!');
          });

      }
      else {
          // more than 12 hours ago
      }
    }
}
