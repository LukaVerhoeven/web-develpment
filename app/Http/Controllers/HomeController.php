<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Photo;
use App\Vote;
use App\User;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $allvotes = Vote::get();
        if (Auth::check()) {
            $votes = Vote::where('user_id', $user->id)->get();
        }


        $images = Photo::orderBy('id', 'asc')->get();
        return view('home' , compact('images','votes','allvotes'));
    }
}
