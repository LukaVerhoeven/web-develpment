<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Wedstrijddate;
use App\User;
use App\Photo;
use App\Vote;
use DB;
use App\Http\Requests;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function __construct()
  {
      $this->middleware('admin');
  }

  public function index()
  {

      $aantal = Wedstrijddate::count();
      $now = Carbon::now();
      $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->exists();
      $allDates = Wedstrijddate::orderBy('id', 'asc')->get();

      $topvoted = Vote::select('photo_id', DB::raw('COUNT(photo_id) as votes'), 'photos.wedstrijd_id', 'users.name' )
      ->leftJoin('photos', 'photo_id', '=', 'photos.id')
      ->leftJoin('users', 'photos.user_id', '=', 'users.id')
      ->groupBy('photo_id')
      ->orderBy('votes', 'desc')
      ->take(10)
      ->get();

      return view('admin', compact('allDates','topvoted','IsContestActive','aantal'));
  }
  public function edit($id)
  {

      // $aantal = Wedstrijddate::count();
      $now = Carbon::now();
      $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->exists();

      $contest = Wedstrijddate::find($id);


      return view('editperiod', compact('IsContestActive','contest'));
  }

  public function createperiod(Request $request)
  {
    $this->validate($request, [
          'price'           =>   'required|max:150',
          'startdate'       =>   'required|before:enddate',
          'enddate'         =>   'required',
      ]);
      
//er mag geen periode aangemaakt worden die overlapt met een periode die al bestaat
  if (!Wedstrijddate::whereBetween('startdate',[$request->startdate, $request->enddate])->exists()) {
      if (!Wedstrijddate::whereBetween('enddate',[$request->startdate, $request->enddate])->exists()) {
        if (!Wedstrijddate::where('startdate','<' , $request->startdate)->where('enddate','>' , $request->enddate)->exists()) {
          $user = Auth::user();
          $wedstrijddate = new Wedstrijddate;
          $wedstrijddate->price     = $request->price;
          $wedstrijddate->startdate = $request->startdate;
          $wedstrijddate->enddate   = $request->enddate;
          $wedstrijddate->save();
          return redirect('/admin')->with('error', 'De periode is succesvol aangemaakt.');
        }else {
          return redirect('/admin')->with('error','This period is in the middle of an already existing period');
        }
      }else {
          return redirect('/admin')->with('error','This period overlaps with an already existing period');
      }
    }else {
      return redirect('/admin')->with('error','This period overlaps with an already existing period');
    }



  }
  public function updateperiod(Request $request,$id)
  {
    $this->validate($request, [
          'price'           =>   'required|max:150',
          'startdate'       =>   'required|before:enddate',
          'enddate'         =>   'required',
      ]);
      $PassValidation = true;
      $startdatevalidate = Wedstrijddate::whereBetween('startdate',[$request->startdate, $request->enddate])->get();
      $enddatevalidate = Wedstrijddate::whereBetween('enddate',[$request->startdate, $request->enddate])->get();
      $bothdatevalidate =Wedstrijddate::where('startdate','<' , $request->startdate)->where('enddate','>' , $request->enddate)->get();

      foreach ($startdatevalidate as $key => $startdate) {
        if ($startdate->id != $id) {
          $PassValidation = false;
          return redirect('/editperiod/'.$id)->with('error','This period overlaps with an already existing period');
        }
      }
      foreach ($enddatevalidate as $key => $enddate) {
        if ($enddate->id != $id) {
          $PassValidation = false;
          return redirect('/editperiod/'.$id)->with('error','This period overlaps with an already existing period');
        }
      }
      foreach ($bothdatevalidate as $key => $date) {
        if ($date->id != $id) {
          $PassValidation = false;
          return redirect('/editperiod/'.$id)->with('error','This period is in the middle of an already existing period');
        }
      }

      if ($PassValidation) {
        $user = Auth::user();
        $wedstrijddate = Wedstrijddate::find($id);
        $wedstrijddate->price     = $request->price;
        $wedstrijddate->startdate = $request->startdate;
        $wedstrijddate->enddate   = $request->enddate;
        $wedstrijddate->save();
        return redirect('/admin')->with('error', 'De periode is succesvol bewerkt.');
      }



  }
}