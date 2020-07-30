@extends('layouts.master')
@section('title') Active Bistro | Tailor Plan @endsection
@section('css') 
<style type="text/css">
	.invalid-feedback{
		display: block !important;
	}
	.error{
		color: red;
	}
</style>
@endsection
@section('content') 

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<form id="msform" class="shadow p-3 mt-5 mb-5">
			        <ul id="progressbar">
					    <li class="active" id="account"><strong>Welcome</strong></li>
						<li class="active" id="personal"><strong>Tailor Plan</strong></li>
					    <li id="payment-status"><strong>Choose Meals</strong></li>
					    <li id="payment"><strong>Checkout</strong></li>
					</ul>
			        <fieldset class="paddingrl">
			        	<div class="row">
			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<label>Height</label>
					        		<input type="text" class="form-control" name="user_height" id="user_height" placeholder="Enter your current Height....">
					        	</div>
			        		</div>

			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<br>
					        		<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" class="custom-control-input" id="metric" value="metric" name="weighttotal">
									  <label class="custom-control-label" for="metric">Metric (kg/cm)</label>
									</div>

									<!-- Default inline 2-->
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" value="imperial" class="custom-control-input" id="imperial" name="weighttotal">
									  <label class="custom-control-label" for="imperial">Imperial (lb)</label>
									</div>
					        	</div>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<label>Current weight</label>
					        		<input type="text" class="form-control"  name="user_weight" id="user_weight" placeholder="Enter your current Weight....">
					        	</div>
			        		</div>

			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<label>Target Weight</label>
					        		<input type="text" class="form-control"  name="user_targert_weight" id="user_targert_weight" placeholder="Enter your target Height....">
					        	</div>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-12">
			        			<div class="form-group">
			        				<label>Weight goal (Select)</label>
			        				<br>

			        				<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" class="custom-control-input weight_goal" id="loose" name="weight_goal" value="loose">
									  <label class="custom-control-label" for="loose">Lose Weight</label>
									</div>

									<!-- Default inline 2-->
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" class="custom-control-input" id="gain" name="weight_goal" value="gain">
									  <label class="custom-control-label" for="gain">Gain Weight</label>
									</div>

									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" class="custom-control-input" id="maintain" name="weight_goal" value="maintain">
									  <label class="custom-control-label" for="maintain">Maintain weight</label>
									</div>
			        			</div>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-12">
			        			<div class="form-group">
			        				<label>What id your activity level <sup class="text-danger">*</sup></label>
			        				<select class="form-control" name="activity_lavel" id="activity_lavel">
			        					<option>Select</option>
			        					<option value="little_or_no_exercise">1- Sedentary - Little or no exercise - (Desk job)</option>
			        					<option value="light_exercise">2 - Lightly Active - Light exercise (Only Light Jogs or Yoga, 1-3 days a week)</option>
			        					<option value="moderate_exercise">3 - Moderately Active - Moderate exercise (Fast Jogs, 3-5 days a week)</option>
			        					<option value="hard_exercise">4 - Very Active - Hard exercise (Gym or Sports (Football etc), 6-7 days a week)</option>
			        					<option value="extra_active">5 - Extra Active - Very Hard, Regular Exercise/Training (Or physically demanding job)</option>
			        					<option value="professional_athlete">6 - Professional Athlete</option>
			        				</select>
			        			</div>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-12">
			        			<div class="form-group text-right">
			        				<p>
			        					<a href="javascript:void(0);" class="font-weight-bold text-color">Skip for now</a>
			        					<!-- <a href="process3.html" class="font-weight-bold text-color">Skip for now</a> -->
			        				</p>
			        			</div>
			        		</div>
			        	</div>

			        	

			        	<div class="form-group">
			        		<!-- <a href="process1.html" type="button" class="btn btn-dark  rounded btn-md"><i class="fa fa-chevron-left mr-2"></i>Back</a> -->
			        		<a href="process3.html" class="btn btn-info  float-right rounded btn-md">Next <i class="fa fa-chevron-right ml-2"></i></a>
			        	</div>
			        	
			        </fieldset>
			    </form>
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