@extends('layouts.master')
@section('title') Active Bistro | SignUp @endsection
@section('csss') 
<style type="text/css"></style>
@endsection
@section('content') 
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-sm-10 col-12 mx-auto">
			<form id="msform" class="shadow p-3 mt-5 mb-5">
				<ul id="progressbar">
					<li class="active" id="account"><strong>Welcome</strong></li>
					<li id="personal"><strong>Planes & Pricing</strong></li>
					<li id="payment-status"><strong>Choose Meals</strong></li>
					<li id="payment"><strong>Checkout</strong></li>
				</ul>
				<fieldset>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label>Sex <span class="text-color sex-icon ml-2 " data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."><i class="fa fa-question-circle"></i></span></label>
						<br>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="male" name="gender">
							<label class="custom-control-label" for="male">Male</label>
						</div>

						<!-- Default inline 2-->
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="femal" name="gender">
							<label class="custom-control-label" for="femal">Female</label>
						</div>
					</div>

					<div class="form-group text-right">
						<label class="mb-0"><a href="javascript:void(0);" id="addGenderInfo" class="text-color">+ Add gender information</a></label>
					</div>

					<div class="form-group">
						<label>Date of Birth</label>
						<input type="date" class="form-control">
					</div>

					<div class="form-group" style="display: none;" id="genderInfo">
						<label class="d-block">Gender information <small>(Optional)</small></label>
						<textarea class="form-control" rows="3"></textarea>
					</div>

					<div class="form-group">
						<label>First Name <span class="text-color sex-icon ml-2 " data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."><i class="fa fa-question-circle"></i></span></label>
						<input type="text" class="form-control">
					</div>

					<div class="form-group">
						<label class="mb-0 text-color font-weight-bold">25% Discounts to Student/Staff or NHS Employee</label>
						<div class="custom-control custom-checkbox ">
							<input type="checkbox" class="custom-control-input" id="verify1" name="gender">
							<label class="custom-control-label" for="verify1">Click to verify</label>
						</div>
					</div> 
					<a href="process2.html" class="btn btn-info float-right rounded btn-md">Continue <i class="fa fa-chevron-right ml-2"></i></a>

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

	$(document).on('click','#addGenderInfo', function(){
		$('#genderInfo').toggle();
	});
	
</script>
@endsection