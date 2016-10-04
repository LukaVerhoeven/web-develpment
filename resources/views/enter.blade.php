@extends('layouts.slider-layout')
@section('title', 'Funny Donkey Contest')

@section('content')
        <div class="container">
            <header>
                <!-- HEADLINE -->
                <h1 data-animated="GoIn"><b>Funny</b> Donkey Contest</h1>
            </header>
            <!-- START TIMER -->
            <div id="timer" data-animated="FadeIn">
                <p id="message"></p>
                <div id="days" class="timer_box"></div>
                <div id="hours" class="timer_box"></div>
                <div id="minutes" class="timer_box"></div>
                <div id="seconds" class="timer_box"></div>
            </div>
            <!-- END TIMER -->
            <div class="col-lg-4 col-lg-offset-4 mt centered">
            	<h4>JOIN AND WIN A WORLD TRIP</h4>
				<form class="form-inline" role="form">
				  <div class="form-group">
				    <label class="sr-only" for="exampleInputEmail2">Email address</label>
				  </div>
          <a  class="btn btn-info"  href="/photos" >See others</a>
				  <a  class="btn btn-danger"  href="/login" >Participate</a>

				</form>
			</div>

        </div>
        <!-- LAYER OVER THE SLIDER TO MAKE THE WHITE TEXTE READABLE -->
@endsection
