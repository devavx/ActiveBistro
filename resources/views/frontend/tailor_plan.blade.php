@extends('layouts.master')
@section('title') Active Bistro | Tailor Plan @endsection
@section('css')
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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
				<form id="msform" class="shadow p-3 mt-5 mb-5" action="{{ route('save_tailor_plan') }}" method="post">
					@csrf
					<ul id="progressbar">
						<li class="active" id="account"><strong>Welcome</strong></li>
						<li class="active" id="personal"><strong>Tailor Plan</strong></li>
						<li id="payment-status"><strong>Choose Meals</strong></li>
						<li id="payment"><strong>Checkout</strong></li>
					</ul>
					<fieldset class="paddingrl">
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group" id="height_metric">
									<label>Height</label>
									<input type="number" min="1.0" max="400.0" step="0.1" class="form-control" name="user_height" id="user_height" placeholder="Enter your current height...">
									<small class="text-color">Centimetres</small>
								</div>
								<div class="form-group" id="height_imperial">
									<label>Height</label>
									<div class="row no-gutters">
										<div class="col-6">
											<input type="number" min="1.00" max="15.00" step="0.1" class="form-control" name="user_height[feet]" id="user_height" placeholder="Feet">
										</div>
										<div class="col-1 text-center my-auto text-color">
											&amp;
										</div>
										<div class="col-5">
											<input type="number" min="0.00" max="12.00" step="0.1" class="form-control" name="user_height[inch]" placeholder="inches">
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group sliderbtncheck">
									<input type="checkbox" checked data-toggle="toggle" data-on="Metric (kg/cm)" data-off="Imperial (lb/ft)" data-onstyle="info" data-offstyle="info" name="unit_system" value="metric">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Current weight</label>
									<input type="number" min="1.0" max="350.0" step="0.1" class="form-control" name="user_weight" id="user_weight" placeholder="Enter your current weight...." onchange="updateWeightGoals('current',this.value);">
									<small class="unit_system_weight text-color">Kilograms</small>
								</div>
							</div>

							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Target weight</label>
									<input type="number" min="1.0" step="0.1" max="350.0" class="form-control" name="user_targert_weight" id="user_targert_weight" placeholder="Enter your target weight...." onchange="updateWeightGoals('target',this.value);">
									<small class="unit_system_weight text-color">Kilograms</small>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Weight goal</label>
									<br>

									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" class="custom-control-input weight_goal" id="loose" name="weight_goal" value="lose">
										<label class="custom-control-label" for="loosexyz">Lose Weight</label>
									</div>

									<!-- Default inline 2-->
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" class="custom-control-input" id="gain" name="weight_goal" value="gain">
										<label class="custom-control-label" for="gainxyz">Gain Weight</label>
									</div>

									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" class="custom-control-input" id="maintain" name="weight_goal" value="maintain">
										<label class="custom-control-label" for="maintainxyz">Maintain weight</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>What is your activity level?<sup class="text-danger">*</sup></label>
									<select class="form-control" name="activity_lavel" id="activity_lavel" required>
										<option value="">Select</option>
										<option value="1">1 - Sedentary - Little or no exercise -
											(Desk job)
										</option>
										<option value="2">2 - Lightly Active - Light exercise (Only Light
											Jogs or Yoga, 1-3 days a week)
										</option>
										<option value="3">3 - Moderately Active - Moderate exercise
											(Fast Jogs, 3-5 days a week)
										</option>
										<option value="4">4 - Very Active - Hard exercise (Gym or Sports
											(Football etc), 6-7 days a week)
										</option>
										<option value="5">5 - Extra Active - Very Hard, Regular
											Exercise/Training (Or physically demanding job)
										</option>
										<option value="6">6 - Professional Athlete</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="form-group text-right">
									<p>
										<a href="{{route('order-now.index')}}" class="font-weight-bold text-color">Skip for now</a>
									</p>
								</div>
							</div>
						</div>


						<div class="form-group">
							<button type="submit" id="register_btn" class="btn btn-info  float-right rounded btn-md">Next
								<i class="fa fa-chevron-right ml-2"></i></button>
						</div>

					</fieldset>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

	<script>
		let weights = {
			current: 0,
			target: 0
		}
		$(document).ready(function () {
			// $('#user_height').inputmask({
			// 	mask: "Foot 999 Inch 999",
			// 	removeMaskOnSubmit: true,
			// });
			$('#height_imperial').hide();

			$("input[name=unit_system]").on('change', function () {
				$("input[name=user_height],input[name=user_weight],input[name=user_targert_weight]").val("");
				if (this.checked) {
					$('#height_imperial').hide();
					$('#height_metric').show();
					$('.unit_system_weight').text('Kilograms');
				} else {
					$('#height_metric').hide();
					$('#height_imperial').show();
					$('.unit_system_weight').text('Pounds');
				}
			});

			$('div.toggle').addClass('w-100').addClass('rounded-0');

			$('#msform').validate({ // initialize the plugin
				rules: {
					user_height: {
						required: true,
						number: true,
					},
					user_weight: {
						required: true,
						number: true,
					},
					user_targert_weight: {
						required: true,
						number: true,
					},
					activity_lavel: {required: true,},
					weight_total: {required: true,},
				},
			});

			$(document).on('click', '#register_btn', function () {
				if (!$("#msform").valid()) { // Not Valid
					return false;
				} else {

				}
			});
		})
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		updateWeightGoals = (type, value) => {
			weights[type] = Number.parseFloat(value);
			let target = null;
			if (weights.current > weights.target) {
				target = 'lose';
			} else if (weights.current < weights.target) {
				target = 'gain';
			} else {
				target = 'maintain';
			}
			$(`input[value=${target}]`).prop('checked', true);
		};
	</script>
@endsection