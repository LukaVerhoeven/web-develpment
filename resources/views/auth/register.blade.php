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
    <h2><b>Funny</b> Donkey Contest</h2>
  </header>



  <div class="form container" id="form">

    <ul class="tab-group">
      <li class="tab active"><a href="#signup">Sign Up</a></li>
      <li class="tab"><a href="/login">Log In</a></li>
    </ul>

    <div class="tab-content">
      <div id="signup">
        <h1>Sign Up for Free</h1>


                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                              
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                          <div class="field-wrap">
                            <label for="name" >Name</label>


                                <input id="name" type="text" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                          <div class="field-wrap">
                            <label for="email" >E-Mail Address</label>

                                <input id="email" type="email"  name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                          <div class="field-wrap">
                            <label for="password" >Password</label>


                                <input id="password" type="password"  name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                          <div class="field-wrap">
                            <label for="password-confirm" >Confirm Password</label>


                                <input id="password-confirm" type="password"  name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div >
                            <div >
                                <button type="submit" class="button button-block">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <div id="login">
                    <form role="form" method="POST" action="{{ url('/login') }}">

                    </form>
                  </div>
              </div>
            </div>


@endsection
