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
       <li class="tab"><a href="#login">Log In</a></li>
     </ul>

     <div class="tab-content">
       <div id="signup">

         <form action="{{ url('/register') }}" method="post">
             {{ csrf_field() }}
         <div class="top-row">
           <div class="field-wrap">
             <label>
               First Name<span class="req">*</span>
             </label>
             <input id="firstname" type="text" name="firstname"  />
           </div>

           <div class="field-wrap">
             <label>
               Last Name<span class="req">*</span>
             </label>
             <input id="lastname" type="text"  name="lastname"/>
           </div>
         </div>

         <div class="field-wrap">
           <label>
             Email Address<span class="req">*</span>
           </label>
           <input id="email" type="email" name="email" />
         </div>

         <div class="field-wrap">
           <label>
             Set A Password<span class="req">*</span>
           </label>
           <input id="password" type="password"required autocomplete="off"/>
         </div>

         <button type="submit" class="button button-block"/>Get Started</button>

         </form>

       </div>

       <div id="login">
         <h1>Welcome Back!</h1>

         <form action="/login" method="post">
           {{ csrf_field() }}
           <div class="field-wrap">
           <label>
             Email Address<span class="req">*</span>
           </label>
           <input id="email" type="email"required autocomplete="off"/>
         </div>

         <div class="field-wrap">
           <label>
             Password<span class="req">*</span>
           </label>
           <input id="password" type="password"required autocomplete="off"/>
         </div>

         <p class="forgot"><a href="#">Forgot Password?</a></p>

         <button class="button button-block"/>Log In</button>

         </form>

       </div>

     </div><!-- tab-content -->

</div> <!-- /form -->
@endsection
