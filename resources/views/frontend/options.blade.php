@extends('layouts.master')
@section('title') Active Bistro | Options @endsection
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
				<form id="msform" class="shadow p-3 mt-5 mb-5" action="{{route('profile_options.save')}}" method="POST">
					@csrf
					<ul id="progressbar">
						<li class="active" id="account"><strong>Welcome</strong></li>
						<li class="active" id="personal"><strong>Tailor Plan</strong></li>
						<li id="payment-status"><strong>Choose Meals</strong></li>
						<li id="payment"><strong>Checkout</strong></li>
					</ul>
					<fieldset class="paddingrl">
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label for="meals_per_day">Meals per day (not including breakfast or snacks)</label>
									<select class="form-control" name="meals_per_day" id="meals_per_day">
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
									</select>
								</div>
							</div>
						</div>


						<button type="button" class="btn btn-info next float-right rounded btn-md">Next
							<i class="fa fa-chevron-right ml-2"></i></button>

					</fieldset>

					<fieldset class="paddingrl">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Meals at weekends?</label>
									<br>

									<div class="row switch-field">
										<div class="col-12">
											<input type="radio" id="radio-one" name="meals_at_weekends" value="1"/>
											<label for="radio-one">Yes</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-two" name="meals_at_weekends" value="0"/>
											<label for="radio-two">No</label>
										</div>
									</div>


								</div>
							</div>
						</div>
						<button type="button" class="btn btn-info next float-right rounded btn-md">Next
							<i class="fa fa-chevron-right ml-2"></i></button>
					</fieldset>

					<fieldset class="paddingrl">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label id="allergies_label">Do you have any allergies?</label>
									<br>

									<div class="row switch-field" id="allergiesRadio">
										<div class="col-12">
											<input type="radio" id="radio-three" name="has_allergies" value="1"/>
											<label for="radio-three">Yes</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-four" name="has_allergies" value="0"/>
											<label for="radio-four">No</label>
										</div>
									</div>

									<div class="btn-group btn-group-toggle d-none allergiesBox mb-2" data-toggle="buttons">
										<label class="btn btn-info m-0 text-capitalize rounded mr-2">
											<input type="checkbox" name="allergies[]" id="option1" value="eggs">Eggs
										</label>
										<label class="btn btn-info m-0 text-capitalize rounded mr-2">
											<input type="checkbox" name="allergies[]" id="option1" value="crustaceans">Crustaceans
										</label>
										<label class="btn btn-info m-0 text-capitalize rounded mr-2">
											<input type="checkbox" name="allergies[]" id="option1" value="fish">Fish
										</label>
										<label class="btn btn-info m-0 text-capitalize rounded mr-2">
											<input type="checkbox" name="allergies[]" id="option1" value="molluscs">Molluscs
										</label>
									</div>
									<div class="btn-group btn-group-toggle d-none allergiesBox" data-toggle="buttons">
										<label class="btn btn-info m-0 text-capitalize rounded mr-2">
											<input type="checkbox" name="allergies[]" id="option1" value="milk">Milk
										</label>
										<label class="btn btn-info m-0 text-capitalize rounded mr-2">
											<input type="checkbox" name="allergies[]" id="option1" value="peanuts">Peanuts
										</label>
									</div>
								</div>
							</div>
						</div>

						<button type="button" class="btn btn-info next float-right rounded btn-md">Next
							<i class="fa fa-chevron-right ml-2"></i></button>
					</fieldset>


					<fieldset class="paddingrl">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Any dietary requirements?<sup class="text-danger">*</sup></label>
									<select class="form-control" name="dietary_requirement">
										<option value="none" selected>None</option>
										<option value="gluten_free">Gluten Free</option>
										<option value="vegetarian">Vegetarian</option>
										<option value="vegan">Vegan</option>
									</select>
								</div>
							</div>
						</div>

						<button class="btn btn-info float-right rounded btn-md">Next
							<i class="fa fa-chevron-right ml-2"></i></button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

@endsection
@section('script')
	<script>
		$(document).ready(function () {
			$("input:radio[name=has_allergies]").change(function () {
				if (this.value == 1) {
					$('#allergies_label').text('Choose one or more...');
					$(".allergiesBox").removeClass("d-none");
					$("#allergiesRadio").addClass("d-none");
				}
			});
			var current_fs, next_fs, previous_fs; //fieldsets
			var opacity;

			$(".next").click(function () {

				current_fs = $(this).parent();
				next_fs = $(this).parent().next();

				//Add Class Active


				//show the next fieldset
				next_fs.show();
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function (now) {
						// for making fielset appear animation
						opacity = 1 - now;

						current_fs.css({
							'display': 'none',
							'position': 'relative'
						});
						next_fs.css({'opacity': opacity});
					},
					duration: 600
				});
			});

			$(".previous").click(function () {

				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();

				//Remove class active
				$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

				//show the previous fieldset
				previous_fs.show();

				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function (now) {
						// for making fielset appear animation
						opacity = 1 - now;

						current_fs.css({
							'display': 'none',
							'position': 'relative'
						});
						previous_fs.css({'opacity': opacity});
					},
					duration: 600
				});
			});


			$(".submit").click(function () {
				return false;
			})

		});
	</script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
@endsection