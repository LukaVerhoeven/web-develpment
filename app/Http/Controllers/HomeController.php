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


    public function index()
    {
        $user = Auth::user();
        $allvotes = Vote::get();
        if (Auth::check()) {
            $votes = Vote::where('user_id', $user->id)->get();
        }
        $now = Carbon::now();
        $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->exists();

        $images = Photo::orderBy('id', 'asc')->get();
        return view('home' , compact('images','votes','allvotes','IsContestActive'));
    }
}
