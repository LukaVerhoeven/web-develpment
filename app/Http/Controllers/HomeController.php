<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Photo;
use App\Vote;
use App\User;
use App\Wedstrijddate;
use Carbon\Carbon;
use Mail;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      /*  $this->middleware('auth'); ( moet ingelogd zijn om naar deze pagina te kunnen )*/
    }
    public function register()
    {
      return view('auth.register');
    }
    public function login()
    {
      return view('auth.login');
    }

    public function welcome()
    {



      $now = Carbon::now();

      $yesterday = strtotime("-24 hours");
      $yesterdaydate = date('Y-m-d', $yesterday);
      $nowdate = $now->format('Y-m-d');

      $Endcontest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->exists();
      $contest = Wedstrijddate::whereBetween('enddate',array($yesterdaydate, $nowdate))->first();
      $topvoted = Vote::select('photo_id', DB::raw('COUNT(photo_id) as votes'),'photos.contestimage', 'photos.wedstrijd_id', 'users.name' )
      ->leftJoin('photos', 'photo_id', '=', 'photos.id')
      ->leftJoin('users', 'photos.user_id', '=', 'users.id')
      ->groupBy('photo_id')
      ->orderBy('votes', 'desc')
      ->where('photos.wedstrijd_id',$contest->id )
      ->first();
      // less than 12 hours ago
      // mail a winner
      $data = [
        'title'=>'U heeft Gewonnen',
        'user'=> $topvoted->name,
        'img' =>$topvoted->contestimage,
        'content'=>'U heeft de hoofdprijs gewonnen met de foto: '
      ];
      Mail::send('auth.emails.wincontest',$data, function ($message)  {

            $message->to("lka.v.lv@gmail.com", "luka")->subject('Your won!');
      });


      if ($Endcontest) {

      }

      $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->exists();
      $contestEnds;
      if ($IsContestActive) {
         $activeContest = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->first();
         $contestEnds = $activeContest->enddate;
    }

      return view('welcome' , compact('contestEnds','IsContestActive'));
    }
    public function index()
    {
        $user = Auth::user();
        $allvotes = Vote::get();
        if (Auth::check()) {
            $votes = Vote::where('user_id', $user->id)->get();
        }
        $now = Carbon::now();
        $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->exists();
        $activeContest;
        $images;
        if ($IsContestActive) {
           $activeContest = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->first();
           $images = Photo::orderBy('id', 'asc')->where('wedstrijd_id',$activeContest->id)->get();
        }


        return view('home' , compact('images','votes','allvotes','IsContestActive'));
    }
}
