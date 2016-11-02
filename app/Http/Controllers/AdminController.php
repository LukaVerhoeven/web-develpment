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
      $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->where('isdeleted',0)->exists();
      $allDates = Wedstrijddate::orderBy('id', 'asc')->where('isdeleted',0)->get();

      $topvoted = Vote::select('photo_id', DB::raw('COUNT(photo_id) as votes'), 'photos.wedstrijd_id', 'photos.isdeleted', 'users.name' )
      ->leftJoin('photos', 'photo_id', '=', 'photos.id')
      ->leftJoin('users', 'photos.user_id', '=', 'users.id')
      ->groupBy('photo_id')
      ->orderBy('votes', 'desc')
      ->where('isdeleted',0)
      ->take(10)
      ->get();

      return view('admin', compact('allDates','topvoted','IsContestActive','aantal', 'now'));
  }
  public function edit($id)
  {

      // $aantal = Wedstrijddate::count();
      $now = Carbon::now();
      $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->where('isdeleted',0)->exists();

      $contest = Wedstrijddate::find($id);


      return view('editperiod', compact('IsContestActive','contest'));
  }
  public function delete($id)
  {
      $contest = Wedstrijddate::find($id);
      $contest->isdeleted = 1;
      $contest->save();
          return redirect('/admin');
  }

  public function createperiod(Request $request)
  {
    $this->validate($request, [
          'price'           =>   'required|max:150',
          'startdate'       =>   'required|before:enddate',
          'enddate'         =>   'required',
      ]);

//er mag geen periode aangemaakt worden die overlapt met een periode die al bestaat
  if (!Wedstrijddate::whereBetween('startdate',[$request->startdate, $request->enddate])->where('isdeleted',0)->exists()) {
      if (!Wedstrijddate::whereBetween('enddate',[$request->startdate, $request->enddate])->where('isdeleted',0)->exists()) {
        if (!Wedstrijddate::where('startdate','<' , $request->startdate)->where('enddate','>' , $request->enddate)->where('isdeleted',0)->exists()) {
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
      $startdatevalidate = Wedstrijddate::whereBetween('startdate',[$request->startdate, $request->enddate])->where('isdeleted',0)->get();
      $enddatevalidate = Wedstrijddate::whereBetween('enddate',[$request->startdate, $request->enddate])->where('isdeleted',0)->get();
      $bothdatevalidate =Wedstrijddate::where('startdate','<' , $request->startdate)->where('enddate','>' , $request->enddate)->where('isdeleted',0)->get();

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
  public function allpics()
  {
    $now = Carbon::now();
    $IsContestActive = Wedstrijddate::where('startdate','<' ,$now)->where('enddate','>' ,$now)->where('isdeleted',0)->exists();
    $allpics = Photo::select('photos.id','votes.photo_id', DB::raw('COUNT(votes.photo_id) as votes'),'photos.contestimage', 'photos.isdeleted','wedstrijddates.price', 'photos.wedstrijd_id', 'users.name' ,'users.email' )
    ->leftJoin('votes',  'photos.id' , '=','votes.photo_id')
    ->leftJoin('users', 'photos.user_id', '=', 'users.id')
    ->leftJoin('wedstrijddates', 'photos.wedstrijd_id', '=', 'wedstrijddates.id')
    ->groupBy('photo_id')
    ->orderBy('votes', 'desc')
    ->get();
    return view('allpics', compact('IsContestActive','contest','allpics'));
  }
  public function deletepic($id)
  {
    $pic = Photo::find($id);
    $pic->isdeleted = 1;
    $pic->save();
    return redirect('/allpics');
  }
  public function recoverpic($id)
  {
    $pic = Photo::find($id);
    $pic->isdeleted = 0;
    $pic->save();
    return redirect('/allpics');
  }
}
