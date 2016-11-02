@extends('layouts.slider-layout')
@section('css')
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="/css/normalize.css">


      <link rel="stylesheet" href="/css/style.css">
@endsection
@section('scripts')
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="/js/login.js"></script>
@endsection
@section('content')
  <header id="head">
    <!-- HEADLINE -->
    <h2><b>Funny</b> Puma Contest</h2>
  </header>



  <div class="form container" id="form">

    <ul class="tab-group">
      <li class="tab"><a href="/register">Sign Up</a></li>
      <li class="tab active"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">
      <div id="login">
        <form role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <div class="field-wrap">
                <label for="email" >E-Mail Address  <span class="req">*</span></label>


                    <input id="email" type="login" name="email" value="{{ old('email') }}" >

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <div class="field-wrap">
                <label for="password" >Password <span class="req">*</span></label>

                    <input id="password" type="password"  name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div>
                    <button type="submit" class="button button-block">
                        Login
                    </button>

                    <a class="forgot" href="{{ url('/password/reset') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
        </form>
      </div>
      <div id="signup">


                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}



                    </form>
                  </div>

              </div>
            </div>


@endsection
