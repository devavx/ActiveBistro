@extends('layouts.master')
@section('title') Active Bistro @endsection
@section('css')
	<style type="text/css"></style>
@endsection
@section('content')
	<div class="top-offer bg-color p-2">
		<div class="container">
			<div class="row">
				<div class="col-12">
					@if($coupon!=null)
						<h6 class="text-white m-0 text-center">
							<a href="#" class="font-weight-bold text-white" data-toggle="tooltip" title="{{$coupon->description}}">{{$coupon->description}}</a>
						</h6>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-0">
				<div class="top-banner">
					<div class="banner-image">

						<!--Carousel Wrapper-->
						<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
							<!--Indicators-->
							<ol class="carousel-indicators">
								@if(!empty($listData))
									@foreach($listData as $key => $rows)
										<li data-target="#carousel-example-1z" data-slide-to="{{ $key }}" class=" @if($key==0) active @endif "></li>
									@endforeach
								@else
									<li data-target="#carousel-example-1z" data-slide-to="1"></li>
								@endif

							</ol>
							<!--/.Indicators-->
							<!--Slides-->
							<div class="carousel-inner" role="listbox">
								<!--First slide-->
								@if(!empty(count($listData)))
									@foreach($listData as $key => $rows)
										<div class="carousel-item @if($key==0) active @endif">
											@if($rows->thumbnail_type == 'video/mp4')
												<video class="video-fluid" autoplay loop muted>
													<source src="{{ $rows->thumbnail }}" type="video/mp4"/>
												</video>
											@else
												<img class="d-block w-100" src="{{ $rows->thumbnail }}" alt="First slide" style="height: 502px;">
											@endif
											<div class="top-banner-text">
												<h4>Delicious. <br> Affordable. <br> Delivered.</h4>
												@guest
													<a href="{{ url('/sign-in') }}" class="btn btn-info btn-md">Get Started
														<i class="fa fa-chevron-right ml-2"></i></a>
												@else
													<a href="{{ url('/sign-in') }}" class="btn btn-info btn-md">Get Started
														<i class="fa fa-chevron-right ml-2"></i></a>
												@endguest
											</div>
										</div>
								@endforeach
							@endif

							<!--/Second slide-->
								<!--Third slide-->
								<!-- <div class="carousel-item">
								  <div class="video-height" style="height: 502px;">
										  <video class="video-fluid" autoplay loop muted  >
											<source src="https://mdbootstrap.com/img/video/forest.mp4" type="video/mp4" />
									  </video>
									  </div>
									<div class="top-banner-text">
										<h4>Delicious. <br> Affordable. <br> Delivered.</h4>
										<a href="login.html" class="btn btn-info btn-md">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
									</div>
								</div> -->
								<!--/Third slide-->
							</div>
							<!--/.Slides-->
							<!--Controls-->
							<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
								<i class="fa fa-chevron-left"></i>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
								<i class="fa fa-chevron-right"></i>
								<span class="sr-only">Next</span>
							</a>
							<!--/.Controls-->
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-12">
				<h3 class="text-center text-color font-weight-bold">How it Work</h3>
			</div>
		</div>
		@if(!empty(count($homeData)))
			@foreach($homeData as $key => $rows)
				<div class="row">
					@if ($key % 2 == 0)
						<div class="col-lg-6 col-sm-6 col-12 aa">
							<div class="home1-img mt-5">
								<img src="{{ $rows->thumbnail }}" class="">
							</div>
						</div>
					@endif
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="home1-text mt-5">
							<h2 class="text-color font-weight-bold">{{ $rows->title }}</h2>
							<p>{!! $rows->description !!}</p>
						</div>
					</div>
					@if ($key % 2 != 0 )
						<div class="col-lg-6 col-sm-6 col-12 xxxxx">
							<div class="home1-img mt-5">
								<img src="{{ $rows->thumbnail }}" class="">
							</div>
						</div>
					@endif
				</div>
			@endforeach
		@endif
	</div>

	@if($section!=null)
		<div class="container mb-5 mt-2">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-12">
					<div class="homehowtext mt-3 pt-3">
						{!! $section->content !!}
						<a href="{{ $section->link }}" class="btn btn-info ml-0">
							{{$section->link_text}}
							<i class="fa fa-chevron-right ml-2"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-6 col-sm-12 col-12">
					<div class="homehowimg mt-3">
						<img src="{{ $section->image }}" class="img-fluid rounded w-100">
					</div>
				</div>
			</div>
		</div>
	@endif
@endsection
@section('script')

	<script>
		let secondsTimer = 43199;
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})

		$(document).ready(function () {
			setInterval(() => {
				secondsTimer--;
				const zeroPadding = (value) => {
					return value < 10 ? "0" + value : value;
				}
				const hours = zeroPadding(Math.floor(secondsTimer / 3600));
				const minutes = zeroPadding(Math.floor(secondsTimer / 60 % 60));
				const second = zeroPadding(parseInt(secondsTimer % 60));
				setTime(hours + 'h:' + minutes + 'm:' + second + 's');
			}, 1000);
		});

		setTime = time => {
			$('.timer_span').html(time);
		}


	</script>
@endsection