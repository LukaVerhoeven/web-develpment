<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wedstrijddate;
use Carbon\Carbon;
use App\Vote;
use DB;
use Carbon\Carbon;
use Mail;

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
      $now = Carbon::now();
      $yesterday = strtotime("-24 hours");
      $yesterdaydate = date('Y-m-d', $yesterday);
      $nowdate = $now->format('Y-m-d');
      $Endcontest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->exists();


      if ($Endcontest) {
          $contest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->first();
          $topvoted = Vote::select('photo_id', DB::raw('COUNT(photo_id) as votes'),'photos.contestimage','wedstrijddates.price', 'photos.wedstrijd_id', 'users.name' ,'users.email' )
          ->leftJoin('photos', 'photo_id', '=', 'photos.id')
          ->leftJoin('users', 'photos.user_id', '=', 'users.id')
          ->leftJoin('wedstrijddates', 'photos.wedstrijd_id', '=', 'wedstrijddates.id')
          ->groupBy('photo_id')
          ->orderBy('votes', 'desc')
          ->where('photos.wedstrijd_id',$contest->id )
          ->first();
          // less than 12 hours ago
          // mail a winner
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

      }
    }
}
