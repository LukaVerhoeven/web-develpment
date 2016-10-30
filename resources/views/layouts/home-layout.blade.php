<!DOCTYPE HTML>
<!--
Multiverse by HTML5 UP
html5up.net | @ajlkn
Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title> @yield('title')</title>


	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="/assets/css/app.css" />
	<link rel="stylesheet" href="/css/font-awesome.min.css" />
	@yield('css')
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			  <a href="/home" class="homebuttona"><img src="/img/puma.png" alt="puma logo" class="homebutton"/></a>
			@if (Auth::guest())
				<h1><strong>all</strong> pics</h1>
			@else
				<h1><strong>{{ Auth::user()->name }}</h1>
				@endif

				<nav>
					<ul>
							<li><a href="/" ><i class="fa fa-clock-o" aria-hidden="true"></i></a></li>
						@if (Auth::guest())
							<li><a href="/login" class="icon fa-sign-in">Login</a></li>
						@else
							@if (Auth::user()->isAdmin)
								<li><a href="/admin" class="icon fa-star-o">admin-panel</a></li>
							@endif


							<li><a href="#footer" class="icon fa-play">participate</a></li>
							<li><a href="/logout" class="icon fa-sign-out">Logout</a></li>
						@endif

					</ul>
				</nav>
			</header>

			@yield('content')

			<!-- Footer -->
			<footer id="footer" class="panel">
				<div class="inner split">
					<div>
						<section>
								@if ($IsContestActive)
							<h2>How to join</h2>
							<p>Upload a funny picture of an animal and win great prices</p>
							@else
								<h2>No Contest Active</h2>
								<p>Wait for the administrator to create a new contest.</p>
							@endif
						</section>


					</div>
					<div>
						<section>
							@if ($IsContestActive)


								<form class="form-horizontal uploadimage" role="form" method="POST" action="{{ url('/photoupload') }}" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<div class="form-group">
										<div class="col-md-12"  >

											<div class="input-group" >
												<label class="input-group-btn "  >
													<span class="btn btn-primary" id="filecss">
														Browse <input type="file" name="contestimage" style="display: none;" multiple>
													</span>
												</label>
												<input type="text" class="form-control" id="inputcss" readonly>
											</div>

											@if ($errors->has('contestimage'))
												<span class="help-block">
													<strong class="validationerror">{{ $errors->first('contestimage') }}</strong>
												</span>
											@endif
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<button type="submit" class="special split" >
												<i ></i>Confirm
											</button>
										</div>
									</div>
								</form>
							@else

							@endif
						</section>

					</div>
				</div>
			</footer>

		</div>

		<!-- Scripts -->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/jquery.poptrox.min.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/util.js"></script>
		<script src="/js/fixes.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="/js/main.js"></script>
		@yield('scripts')

	</body>
	</html>
