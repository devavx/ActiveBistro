@extends('layouts.master')
@section('title') Active Bistro | Recommended Daily Intake @endsection
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
						<div class="col-lg-6 col-sm-8 col-12 mx-auto">
							<p class="border p-2 text-center text-color">Recommended Daily Intake</p>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-10 col-sm-10 col-12 mx-auto">
							@php
                                $userGender = Auth::user()->gender ?? 'male';
                                $weightInKG = Auth::user()->user_weight ?? '1';
                                $heighIntCM = Auth::user()->user_height ?? '1';
                                $age = getAge(Auth::user()->dob, date('Y-m-d'))
                            @endphp
							<table class="table table-striped table-bordered">
								<tr class="text-center">
									<th class="p-2 w-50">Calories</th>
									<td class="p-2 w-50" colspan="2">{{ getCalories($userGender,$weightInKG,$heighIntCM,$age) }} kcal</td>
								</tr>

								<tr class="text-center">
									<td class="p-2">180 g</td>
									<td class="p-2">90 g</td>
									<td class="p-2">364 g</td>
								</tr>

								<tr class="text-center">
									<th class="p-2">Protein</th>
									<th class="p-2">Fat</th>
									<th class="p-2">Carbohydrate</th>
									
								</tr>
							</table>
						</div>
					</div>

					<!-- <a href="process2.html" type="button" class="btn btn-dark  rounded btn-md"><i class="fa fa-chevron-left mr-2"></i>Back</a> -->
					
					<!-- <a href="process4.html" class="btn btn-info  mt-3 float-right rounded btn-md">Next <i class="fa fa-chevron-right ml-2"></i></a> -->
					<button type="buttonn" class="btn btn-info  mt-3 float-right rounded btn-md">Next <i class="fa fa-chevron-right ml-2"></i></button>
					
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
	});
</script>
@endsection 