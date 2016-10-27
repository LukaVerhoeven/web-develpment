@extends('layouts.home-layout')
@section('title', 'All Pictures')

@section('content')

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
@endsection
