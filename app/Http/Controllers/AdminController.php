<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Wedstrijddate;
use App\user;
use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
  {
      $this->middleware('admin');
  }

  public function index()
  {

      return view('admin');
  }

  public function createproject(Request $request)
  {
    $this->validate($request, [
          'price'           =>   'required|max:150',
          'startdate'       =>   'required',
          'enddate'         =>   'required',
      ]);
    $user = Auth::user();
    $wedstrijddate = new Wedstrijddate;
    $wedstrijddate->price     = $request->price;
    $wedstrijddate->startdate = $request->startdate;
    $wedstrijddate->enddate   = $request->enddate;
    $wedstrijddate->save();
      return view('admin');
  }
}
