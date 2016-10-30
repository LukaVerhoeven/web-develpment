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
