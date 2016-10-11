<!DOCTYPE HTML>
<!--
	Multiverse by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>

          <title>All Pictures</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="/css/main.css" />
    	<link rel="stylesheet" href="/assets/css/app.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
            @if (Auth::guest())
                <h1><a href="#"><strong>all</strong> pics </a></h1>
              @else
                <h1><a href="#"><strong>{{ Auth::user()->name }} </a></h1>
              @endif

						<nav>
							<ul>

                @if (Auth::guest())
                      <li><a href="/login" class="icon fa-info-circle">Login</a></li>
                  @else
										<li><a href="#footer" class="icon fa-info-circle">participate</a></li>
                    <li><a href="/logout" class="icon fa-info-circle">Logout</a></li>
                  @endif

							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
						@foreach( $images as $image)
							<article class="thumb">
								<a href="{{$image->contestimage}}" class="image"><img src="{{$image->contestimage}}" alt="" /></a>
								<h2>{{$image->user->name}}</h2>
								@if (!Auth::guest())

										@if ($votes->where('photo_id', $image->id )->isEmpty())
											<a href="/vote/{{$image->id}}" class="vote" >upvote</a>
										@else
											@foreach ($votes as $vote)
													@if ($vote->photo_id == $image->id)
														<a href="/removevote/{{$vote->id}}" class="vote removevote" >remove vote</a>
													@endif
											@endforeach
										@endif
									@endif
								<h3 class="allvotes"> {{$allvotes->where('photo_id', $image->id )->count()}} votes</h3>
							</article>

						@endforeach
						<article class="thumb">
							<a href="/img/images/fulls/01.jpg" class="image"><img src="/img/images/thumbs/01.jpg" alt="" /></a>
							<h2>Magna feugiat lorem</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/mages/fulls/02.jpg" class="image"><img src="/img/images/thumbs/02.jpg" alt="" /></a>
							<h2>Nisl adipiscing</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/03.jpg" class="image"><img src="/img/images/thumbs/03.jpg" alt="" /></a>
							<h2>Tempus aliquam veroeros</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/04.jpg" class="image"><img src="/img/images/thumbs/04.jpg" alt="" /></a>
							<h2>Aliquam ipsum sed dolore</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/05.jpg" class="image"><img src="/img/images/thumbs/05.jpg" alt="" /></a>
							<h2>Cursis aliquam nisl</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/06.jpg" class="image"><img src="/img/images/thumbs/06.jpg" alt="" /></a>
							<h2>Sed consequat phasellus</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/07.jpg" class="image"><img src="/img/images/thumbs/07.jpg" alt="" /></a>
							<h2>Mauris id tellus arcu</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/08.jpg" class="image"><img src="/img/images/thumbs/08.jpg" alt="" /></a>
							<h2>Nunc vehicula id nulla</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/09.jpg" class="image"><img src="/img/images/thumbs/09.jpg" alt="" /></a>
							<h2>Neque et faucibus viverra</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/10.jpg" class="image"><img src="/img/images/thumbs/10.jpg" alt="" /></a>
							<h2>Mattis ante fermentum</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/11.jpg" class="image"><img src="/img/images/thumbs/11.jpg" alt="" /></a>
							<h2>Sed ac elementum arcu</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
						<article class="thumb">
							<a href="/img/images/fulls/12.jpg" class="image"><img src="/img/images/thumbs/12.jpg" alt="" /></a>
							<h2>Vehicula id nulla dignissim</h2>
							<p>Nunc blandit nisi ligula magna sodales lectus elementum non. Integer id venenatis velit.</p>
						</article>
					</div>

				<!-- Footer -->
					<footer id="footer" class="panel">
						<div class="inner split">
							<div>
								<section>
									<h2>How to join</h2>
									<p>Upload a funny picture of an animal and win great prices</p>
								</section>


							</div>
							<div>
								<section>
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

	</body>
</html>
