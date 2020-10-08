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
				<form id="msform" class="shadow p-3 mt-5 mb-5" action="{{route('desired-progress.store')}}" method="post">
					@csrf
					<ul id="progressbar">
						<li class="active" id="account"><strong>Welcome</strong></li>
						<li class="active" id="personal"><strong>Tailor Plan</strong></li>
						<li id="payment-status"><strong>Choose Meals</strong></li>
						<li id="payment"><strong>Checkout</strong></li>
					</ul>
					<fieldset class="paddingrl">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>What is your desired weekly progress?<sup class="text-danger">*</sup></label>
									<select class="form-control" name="weekly_progress" id="activity_lavel" required>
										<option value="">Choose</option>
										@if(auth()->user()->unit_system==\App\Core\Enums\Common\UnitSystem::Metric)
											<option value="0.5">Gain 0.5 KG per week</option>
											<option value="0.2">Gain 0.2 KG per week</option>
											<option value="0">Maintain weight</option>
											<option value="-0.2">Lose 0.2 KG per week</option>
											<option value="-0.5">Lose 0.5 KG per week</option>
											<option value="-0.8">Lose 0.8 KG per week</option>
											<option value="-1">Lose 1 KG per week</option>
										@else
											<option value="1">Gain 1 LB per week</option>
											<option value="0.5">Gain 0.5 LB per week</option>
											<option value="0">Maintain weight</option>
											<option value="-0.5">Lose 0.5 LB per week</option>
											<option value="-1">Lose 1 LB per week</option>
											<option value="-1.5">Lose 1.5 LB per week</option>
											<option value="-2">Lose 2 LB per week</option>
										@endif
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" id="register_btn" class="btn btn-info  float-right rounded btn-md">Next
								<i class="fa fa-chevron-right ml-2"></i>
							</button>
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
		});
	</script>
@endsection 