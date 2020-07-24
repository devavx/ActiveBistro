@extends('layouts.master')
@section('title') Active Bistro @endsection
@section('csss') 
<style type="text/css"></style>
 @endsection
@section('content') 
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-0">
				<div class="top-banner">
					<div class="banner-image">

						<!--Carousel Wrapper-->
						<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
						  <!--Indicators-->
						  <ol class="carousel-indicators">
						    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
						    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
						    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
						  </ol>
						  <!--/.Indicators-->
						  <!--Slides-->
						  <div class="carousel-inner" role="listbox">
						    <!--First slide-->
						    <div class="carousel-item active">
						      <img class="d-block w-100" src="{{ asset('uploads/image/banner.png') }}"
						        alt="First slide">
						        <div class="top-banner-text">
									<h4>Delicious. <br> Affordable. <br> Delivered.</h4>
									<a href="login.html" class="btn btn-info btn-md">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
								</div>
						    </div>
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
									<a href="login.html" class="btn btn-info btn-md">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
								</div>
						    </div>
						    <!--/Second slide-->
						    <!--Third slide-->
						    <div class="carousel-item">
						      <div class="video-height" style="height: 502px;">
						      		<video class="video-fluid" autoplay loop muted  >
							        	<source src="https://mdbootstrap.com/img/video/forest.mp4" type="video/mp4" />
							      </video>
						      	</div>
						        <div class="top-banner-text">
									<h4>Delicious. <br> Affordable. <br> Delivered.</h4>
									<a href="login.html" class="btn btn-info btn-md">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
								</div>
						    </div>
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

	<div class="container mt-5  mb-5">
		<div class="row">
			<div class="col-12">
				<h2 class="font-weight-bold text-center text-color">Our Plans</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-sm-4 col-12">
				<div class="homeplan text-center shadow pb-3 mt-3">
					<div class="homeplan-header bg-color p-2 mb-3">
						<h6 class="mb-0 text-white">Meal for 6 days (Mon-Sat)</h6>
					</div>

					<h5 class="font-weight-bold text-color">From £2.00 Per Meal</h5>
					<p class="font-weight-bold text-color">12 Meals - 2/Day</p>
					<p>£29.88</p>
					<p class="font-weight-bold text-color">18 Meals - 3/Day</p>
					<p>£36.00</p>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="homeplan text-center shadow pb-3 mt-3">
					<div class="homeplan-header bg-color p-2 mb-3">
						<h6 class="mb-0 text-white">Meal for 7 days (Mon-Sun)</h6>
					</div>

					<h5 class="font-weight-bold text-color">From £1.90 Per Meal</h5>
					<p class="font-weight-bold text-color">14 Meals - 2/Day</p>
					<p>£28.70</p>
					<p class="font-weight-bold text-color">21 Meals - 3/Day</p>
					<p>£39.90</p>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="homeplan text-center shadow pb-3 mt-3">
					<div class="homeplan-header bg-color p-2 mb-3">
						<h6 class="mb-0  text-white">Weekend Meals</h6>
					</div>

					<h5 class="font-weight-bold text-color">From £2.00 Per Meal</h5>
					<p class="font-weight-bold text-color">10 Meals - 2/Day</p>
					<p>£25.00</p>
					<p class="font-weight-bold text-color">15 Meals - 3/Day</p>
					<p>£30.00</p>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="homeplan text-center shadow pb-3 mt-3">
					<div class="homeplan-header bg-color p-2 mb-3">
						<h6 class="mb-0 text-white">7 Day Meals</h6>
					</div>

					<h5 class="font-weight-bold text-color">From £2.50 Per Meal</h5>
					<p class="font-weight-bold text-color">14 Meals - 2/Day</p>
					<p>£42.00</p>
					<p class="font-weight-bold text-color">21 Meals - 3/Day</p>
					<p>£52.50</p>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="homeplan text-center shadow pb-3 mt-3">
					<div class="homeplan-header bg-color p-2 mb-3">
						<h6 class="mb-0 text-white">Monday - Friday</h6>
					</div>

					<h5 class="font-weight-bold text-color">From £2.00 Per Meal</h5>
					<p class="font-weight-bold text-color">10 Meals - 2/Day</p>
					<p>£30.00</p>
					<p class="font-weight-bold text-color">10 Meals - 3/Day</p>
					<p>£20.00</p>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-12 text-center">
				<a href="signup.html" class="btn btn-info">Get Started <i class="fa fa-chevron-right ml-2"></i></a>
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