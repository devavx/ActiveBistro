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
					<h6 class="text-white m-0 text-center">Seen us on <a href="#" class="font-weight-bold text-white" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.">Click Here to get 50% OFF your first 2 boxes.</a></h6>
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
						    @if(!empty($listData))
						    	@foreach($listData as $key => $rows)
								    <div class="carousel-item @if($key==0) active @endif" style="height: 502px;">
								    	@if($rows->thumbnail_type == 'video/mp4')
                                            <video class="video-fluid" autoplay loop muted  >
                                            <source src="{{ $rows->thumbnail }}" type="video/mp4" />
                                      </video>
                                        @else	
								      <img class="d-block w-100" src="{{ $rows->thumbnail }}" alt="First slide" style="height: 502px;">
								      @endif
								        <div class="top-banner-text">
											<h4>Delicious. <br> Affordable. <br> Delivered.</h4>
											@guest
												<a href="{{ url('/sign-in') }}" class="btn btn-info btn-md">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
											@else
												<a href="{{ url('/sign-in') }}" class="btn btn-info btn-md">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
											@endguest
										</div>
								    </div>
								@endforeach
							@else
						    <!--/First slide-->
						    <!--Second slide-->
							    <div class="carousel-item">
							      	<div class="video-height" style="height: 502px;">
							      		<video class="video-fluid" autoplay loop muted  >
								        	<source src="https://mdbootstrap.com/img/video/Agua-natural.mp4" type="video/mp4" />
								      </video>
							      	</div>
							        <div class="top-banner-text">
										<h4>Delicious. <br> Affordable. <br> Delivered.</h4>
										<a href="{{ url('/sign-in') }}" class="btn btn-info btn-md">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
									</div>
							    </div>
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

					<div class="banner-right-side pt-5">
						<div class="banner-right-text">
							<a href data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."><img src="{{ asset('uploads/image/c1.png') }}"></a>
							<a href data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."><img src="{{ asset('uploads/image/c3.png') }}"></a>
							<a href data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."><img src="{{ asset('uploads/image/c3.png') }}"></a>
							<a href data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."><img src="{{ asset('uploads/image/c4.png') }}"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-12">
				<div class="home1-img mt-5">
					<img src="{{ asset('uploads/image/home1.jpg') }}" class="">
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-12">
				<div class="home1-text mt-5">
					<h2 class="text-color font-weight-bold">Choose your meals</h2>
					<p>Our chef-designed recipes include balanced Mediterranean meals, quick one-pan dinners, and top-rated customer favorites.</p>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="col-lg-6 col-sm-6 col-12">
				<div class="home1-text mt-5">
					<h2 class="text-color font-weight-bold">Unpack your box</h2>
					<p>We guarantee the freshness of all our ingredients and deliver them in an insulated box right to your door.</p>
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-12">
				<div class="home1-img mt-5">
					<img src="{{ asset('uploads/image/home2.jpg') }}" class="">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 col-sm-6 col-12">
				<div class="home1-img mt-5">
					<img src="{{ asset('uploads/image/home3') }}.jpg" class="">
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-12">
				<div class="home1-text mt-5">
					<h2 class="text-color font-weight-bold">Create magic</h2>
					<p>Following our step-by-step instructions you’ll experience the magic of cooking recipes that our chefs create with your family’s tastes in mind.</p>
				</div>
			</div>
		</div>


	</div>
 @endsection
 @section('script')
	 
   <script>
   	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
   </script>
 @endsection