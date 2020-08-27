@extends('layouts.master')
@section('title') Active Bistro | Recommended Daily Intake @endsection
@section('css')
	<style type="text/css">
        .invalid-feedback {
            display: block !important;
        }

        .error {
            color: red;
        }
	</style>
@endsection
@section('content')


	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<form id="msform" class="shadow p-3 mt-5 mb-5">
					@csrf
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
								<table class="table table-striped table-bordered">
									<tr class="text-center">
										<th class="p-2 w-50">Calories</th>
										<td class="p-2 w-50" colspan="2">{{ auth()->user()->calories() }}
											kcal
										</td>
									</tr>

									<tr class="text-center">
										<td class="p-2">{{auth()->user()->proteins()}} g</td>
										<td class="p-2">{{auth()->user()->fats()}} g</td>
										<td class="p-2">{{auth()->user()->carbohydrates()}} g</td>
									</tr>

									<tr class="text-center">
										<th class="p-2">Protein</th>
										<th class="p-2">Fat</th>
										<th class="p-2">Carbohydrate</th>

									</tr>
								</table>
							</div>
						</div>

						<a href="{{route('profile_options')}}" class="btn btn-info  mt-3 float-right rounded btn-md">Next
							<i class="fa fa-chevron-right ml-2"></i></a>

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