<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Photo;
use App\user;
use App\Vote;
use Intervention\Image\ImageManagerStatic as Image;


class ContestController extends Controller
{
  public function addphoto(Request $request)
  {
    $this->validate($request, [
            'profileimage'		=>   'image',
        ]);

        if (Input::hasFile('contestimage') && Input::file('contestimage')->isValid())
    		{
    			   $user = Auth::user();
             $image = new Photo;


    	        $destinationPath = '/public/img';
    	        $extension = Input::file('contestimage')->getClientOriginalExtension();
    	        $fileName = '/img/' . uniqid().'.'.$extension;
              $path =  public_path('img/images/fulls/' . $fileName);

    	        Input::file('contestimage')->move(base_path() . $destinationPath, $fileName);

              // Image::make($path /*error*/ )->fit(340, 340)->save('uploads/resized-image.jpg');

              $image->contestimage  = $fileName;
              $image->User()->associate($user);
              $image->save();
            }

            return redirect('/home');
  }

  public function vote($id)
  {

    $user = Auth::user();
    $vote = new Vote;
    $UserAlreadyVotedOnPic = Vote::where('user_id', $user->id)->where('photo_id', $id)->get();

    if ($UserAlreadyVotedOnPic->isEmpty()) {
        $vote->photo_id = $id;
        $vote->User()->associate($user);
        $vote->save();
    }


      return redirect('/home');
  }


  public function removevote($id)
  {

    $vote = Vote::find($id);
    $vote->delete();

      return redirect('/home');
  }





}
