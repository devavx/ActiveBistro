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
				<div class="mt-5">
					@if($message=Session::get('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong> {{$message}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif

					@if($errormessage=Session::get('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong> {{$errormessage}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					@if(count($errors) > 0 )
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<ul class="p-0 m-0" style="list-style: none;">
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
				<form id="msform" class="shadow p-3 mt-5 mb-5" action="{{route('order-now.store')}}" method="POST">
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
										@for($i=2;$i<=6;$i++)
											<option value="{{$i}}" @if(auth()->user()->recommendedMealsPerDay()==$i) selected @endif>{{$i}}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>
						<button type="button" class="m-0 btn btn-info next float-right rounded btn-md">Next<i class="fa fa-chevron-right ml-2"></i>
						</button>
					</fieldset>

					<fieldset class="paddingrl" id="allergiesRadio0">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Would you like breakfast in your plan?</label>
									<br>

									<div class="row switch-field">
										<div class="col-12">
											<input type="radio" id="radio-one" value="1" name="wantBreakfast"/>
											<label for="radio-one" class="brakfast_name">Yes</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-two" value="0" name="wantBreakfast"/>
											<label for="radio-two" class="brakfast_name">No</label>
										</div>
									</div>


								</div>
							</div>
						</div>
						<button type="button" class="m-0 btn btn-info next float-right rounded btn-md d-none" id="breakfastNext">Next<i class="fa fa-chevron-right ml-2"></i>
						</button>
						<button type="button" class="m-0 btn btn-info float-right rounded btn-md" onclick="resetQuestions();">Reset</button>
					</fieldset>

					<fieldset class="paddingrl" id="allergiesRadio2">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>How many snacks do you want per day?</label>
									<br>

									<div class="row switch-field">
										<div class="col-12">
											<input type="radio" id="radio-three" value="1" name="snacksPerDay"/>
											<label for="radio-three" class="snack_count">1 Snack per day</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-four" value="2" name="snacksPerDay"/>
											<label for="radio-four" class="snack_count">2 Snacks per day</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-five" value="3" name="snacksPerDay"/>
											<label for="radio-five" class="snack_count">3 Snacks per day</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-six" value="0" name="snacksPerDay"/>
											<label for="radio-six" class="snack_count">No Snacks</label>
										</div>


									</div>

								</div>
							</div>
						</div>
						<button type="button" class="m-0 btn btn-info next float-right rounded btn-md d-none" id="snacksNext">Next<i class="fa fa-chevron-right ml-2"></i>
						</button>
						<button type="button" class="m-0 btn btn-info float-right rounded btn-md" onclick="resetQuestions();">Reset</button>
					</fieldset>


					<fieldset class="paddingrl" id="allergiesRadio3">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Meals on weekends?</label>
									<br>

									<div class="row switch-field">
										<div class="col-12">
											<input type="radio" id="radio-seven" name="meals_at_weekends" value="1"/>
											<label for="radio-seven" class="weekend_mail">Yes</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-eight" name="meals_at_weekends" value="0"/>
											<label for="radio-eight" class="weekend_mail">No</label>
										</div>
									</div>


								</div>
							</div>
						</div>
						<button type="button" class="m-0 btn btn-info next float-right rounded btn-md d-none" id="weekendsNext">Next<i class="fa fa-chevron-right ml-2"></i>
						</button>
						<button type="button" class="m-0 btn btn-info float-right rounded btn-md" onclick="resetQuestions();">Reset</button>
					</fieldset>

					<fieldset class="paddingrl" id="allergiesRadio4">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label id="allergies_label">Do you have any allergies?</label>
									<br>

									<div class="row switch-field" id="allergiesRadio">
										<div class="col-12">
											<input type="radio" id="radio-nine" name="has_allergies" value="1"/>
											<label for="radio-nine">Yes</label>
										</div>

										<div class="col-12">
											<input type="radio" id="radio-ten" name="has_allergies" value="0"/>
											<label for="radio-ten">No</label>
										</div>
									</div>

									@foreach($allergies as $set)
										<div class="btn-group btn-group-toggle d-none allergiesBox mb-2" data-toggle="buttons">
											@foreach($set as $allergy)
												<label class="btn btn-info m-0 text-capitalize rounded mr-2">
													<input type="checkbox" name="allergies[]" id="option1" value="{{$allergy['id']}}">{{$allergy['name']}}
												</label>
											@endforeach
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<button type="button" class="m-0 btn btn-info next float-right rounded btn-md d-none" id="allergiesNext">Next<i class="fa fa-chevron-right ml-2"></i>
						</button>
						<button type="button" class="m-0 mr-1 btn btn-info float-right rounded btn-md" onclick="resetQuestions();">Reset</button>
					</fieldset>


					<fieldset class="paddingrl" id="lastFieldset">
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

						<button type="submit" class="m-0 next btn btn-info float-right rounded btn-md">Next<i class="fa fa-chevron-right ml-2"></i>
							<button type="button" class="m-0 mr-1 btn btn-info float-right rounded btn-md" onclick="resetQuestions();">Reset</button>
						</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

@endsection
@section('script')
	<script>
		let current, next, opacity;
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		$(document).ready(function () {
			$("input:radio[name=has_allergies]").change(function () {
				if (this.value == 1) {
					$('#allergies_label').text('Choose one or more...');
					$(".allergiesBox").removeClass("d-none");
					$("#allergiesRadio").addClass("d-none");
					$('#allergiesNext').removeClass('d-none');
				} else {
					$('#allergiesNext').trigger('click');
				}
			});
			$(".next").click(function () {
				current = $(this).parent();
				next = $(this).parent().next();
				current.animate({'opacity': 0}, 'fast', 'swing', () => {
					current.hide();
					next.show();
				});
			});

			$(".submit").click(function () {
				return false;
			})

			$(".brakfast_name").click(function () {
				$('#breakfastNext').trigger('click');
			});

			$(".snack_count").click(function () {
				$('#snacksNext').trigger('click');
			});

			$(".weekend_mail").click(function () {
				$('#weekendsNext').trigger('click');
			});
		});

		function resetQuestions() {
			bootbox.confirm({
				title: 'Are your sure?',
				message: "This will reset all options!",
				centerVertical: true,
				buttons: {
					confirm: {
						label: 'Yes',
						className: 'btn-info'
					},
					cancel: {
						label: 'No',
						className: 'btn-grey'
					}
				},
				callback: function (result) {
					if (result) {
						window.location.href = "/order-now";
					}
				}
			});
		}
	</script>
@endsection