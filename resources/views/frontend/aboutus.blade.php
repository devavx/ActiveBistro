@extends('layouts.master')
@section('title') Active Bistro | Cantact Us @endsection
@section('csss') 
<style type="text/css"></style>
@endsection
@section('content') 
<div class="container-fluid">
	<div class="row">
		<div class="col-12 p-0">
			<div class="about-video">
				<img src="{{ asset('uploads/image/about1.jpg') }}" class="img-fluid w-100 d-block">
			</div>
		</div>
	</div>
</div>

<div class="container mt-5 ">
	<div class="row">
		<div class="col-lg-8 col-sm-10 col-12 mx-auto text-center">
			<h3 class="font-weight-bold text-color">Who we are</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
</div>

	<!-- <div class="bg-color pt-5 pb-5 mt-5 mb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-sm-6 col-12 mx-auto text-center">
					<h4 class="font-weight-bold text-white m-0">OUR MISSION IS TO BRING <br>
					PEOPLE COMFORT THROUGH FOOD.</h4>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-12">
				
				<div class="ourvision-mission shadow p-3">
					<ul class="nav nav-pills" role="tablist">
				  
					  	<li class="nav-item">
					    	<a class="nav-link active" data-toggle="tab" href="#vision" role="tab" >Our Vision</a>
					  	</li>
					  	<li class="nav-item">
					   	 	<a class="nav-link" data-toggle="tab" href="#mission" role="tab">Our Mission</a>
					  	</li>
					</ul>


					<div class="tab-content pt-3">
					    
					    <div class="tab-pane active" id="vision" role="tabpanel">
					      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					    </div>

					    <div class="tab-pane" id="mission" role="tabpanel">
					      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					    </div>
					    
					</div>
				</div>
			</div>
		</div>
	</div> -->
	@endsection
	@section('script')
	<script>
	</script>
	@endsection