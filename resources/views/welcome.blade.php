@extends('layouts.slider-layout')
@section('title', 'Funny Donkey Contest')

@section('content')
        <div class="container">



            <header>
                <!-- HEADLINE -->
                <h1 data-animated="GoIn"><b>Funny</b> Puma Contest</h1>
            </header>
            <!-- START TIMER -->
              @if ($IsContestActive)
            <div id="timer" data-animated="FadeIn">
                <p id="message"></p>
                <div id="days" class="timer_box"></div>
                <div id="hours" class="timer_box"></div>
                <div id="minutes" class="timer_box"></div>
                <div id="seconds" class="timer_box"></div>
            </div>
            <!-- END TIMER -->
            <div class="col-lg-4 col-lg-offset-4 mt centered">
            	<h4>JOIN AND WIN A {{$activeContest->price}}</h4>
				<form class="form-inline" role="form">
				  <div class="form-group">
				    <label class="sr-only" for="exampleInputEmail2">Email address</label>
				  </div>
          <a  class="btn btn-info"  href="/home" >See others</a>
          @if (Auth::guest())
              <a  class="btn btn-danger"  href="/register" >Participate</a>
          @endif
          <input type="hidden" name="name" id="enddate" value="{{$contestEnds}}">
        @else
          	<h4>Contest has ended</h4>
            @if ($ContestExists)
              <h4>{{$lastcontest->won}} has won a {{$lastcontest->price}}</h4>
            @endif
            <a  class="btn btn-info"  href="/home" >homepanel</a>
            <a  class="btn btn-danger"  href="/login" >Login</a>
        @endif



				</form>
			</div>

        </div>
        <!-- LAYER OVER THE SLIDER TO MAKE THE WHITE TEXTE READABLE -->
@endsection
