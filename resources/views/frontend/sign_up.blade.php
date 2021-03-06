@extends('layouts.master')
@section('title') Active Bistro | SignUp @endsection
@section('css')
	<!-- Date picker plugins css -->
	<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
	<style type="text/css">
        .invalid-feedback {
            display: block !important;
        }

        label.error {
            font-size: 80%;
            font-weight: 400;
        }

        .ti-angle-right:before {
            content: "<";
        }

        .ti-angle-left:before {
            content: ">";
        }
	</style>
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<form id="msform" class="shadow p-3 mt-5 mb-5" method="POST" action="{{ route('register') }}">
					@csrf
					<ul id="progressbar">
						<li class="active" id="account"><strong>Welcome</strong></li>
						<li id="personal"><strong>Tailor Plan</strong></li>
						<li id="payment-status"><strong>Choose Meals</strong></li>
						<li id="payment"><strong>Checkout</strong></li>
					</ul>
					<fieldset class="paddingrl">
						<div class="form-group">
							<label>Email <sup class="text-danger">*</sup></label>
							<input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" maxlength="100">
							@error('email')
							<span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
							@enderror
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Password <sup class="text-danger">*</sup></label>
									<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" required autocomplete="password" minlength="8" maxlength="64">
									<small id="password-strength" class="text-color"></small>
								</div>
								@error('password')
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>
							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Confirm Password <sup class="text-danger">*</sup></label>
									<input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" value="" required autocomplete="password" minlength="8" maxlength="64">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="form-group">
									<label>Phone <sup class="text-danger">*</sup></label>
									<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" required autocomplete="phone" minlength="11" maxlength="11">
									<small>A phone number is required for delivery purposes only.</small>
								</div>
								@error('phone')
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group">
									<label>First Name <sup class="text-danger">*</sup></label>
									<input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" minlength="2" maxlength="25" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
								</div>
								@error('first_name')
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>


							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Last Name <sup class="text-danger">*</sup></label>
									<input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" minlength="2" maxlength="25">
								</div>
								@error('last_name')
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>


						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<label>Sex <sup class="text-danger">*</sup>
										<span class="text-color sex-icon ml-2 " data-toggle="tooltip" title="{{__("strings.gender_info")}}"><i class="fa fa-question-circle"></i></span></label>
								</div>

								<div class="col-lg-6 col-sm-6 col-12">
									<span class="float-right"><a href="javascript:void(0);" id="addGenderInfo" class="text-color" data-toggle="collapse" data-target="#genderInfo" data-text-alt="- Hide gender information">+ Add gender information</a></span>
								</div>
							</div>

							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" value="male" class="custom-control-input" id="male" name="gender" checked>
								<label class="custom-control-label" for="male">Male</label>
							</div>

							<!-- Default inline 2-->
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" value="female" class="custom-control-input" id="female" name="gender">
								<label class="custom-control-label" for="female">Female</label>
							</div>
							@error('gender')
							<span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
							@enderror
						</div>

						<div class="form-group collapse" id="genderInfo">
							<label class="d-block">Gender information <small>(Optional)</small></label>
							<textarea class="form-control" rows="3" name="gender_info" id="gender_info" maxlength="255">{{ old('password') }}</textarea>
						</div>

						<div class="form-group">
							<label>Date of Birth <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" name="dob" id="datepicker" value="{{ old('dob') }}">
							@error('dob')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>
						<div class="form-group">
							<a href="{{ url('/sign-in') }}" class="btn btn-dark rounded btn-md"><i class="fa fa-chevron-left mr-2"></i>Login</a>
							<button type="submit" id="register_btn" class="btn btn-info float-right rounded btn-md">Next
								<i class="fa fa-chevron-right ml-2"></i></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
	<script>
		const strength = {
			0: "Very bad",
			1: "Bad",
			2: "Weak",
			3: "Good",
			4: "Strong"
		}
		let checked = false;

		$("#datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			startDate: '{{date('Y-m-d',0)}}',
			endDate: '-18y',
			format: 'dd/mm/yyyy'
		});

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})

		jQuery(function ($) {
			$('#addGenderInfo[data-toggle="collapse"]').on('click', function () {
				$(this)
					.data('text-original', $(this).text())
					.text($(this).data('text-alt'))
					.data('text-alt', $(this).data('text-original'));
			});
		});
		$(document).ready(function () {
			var password = document.getElementById('password');
			var text = document.getElementById('password-strength');
			password.addEventListener('input', function () {
				var val = password.value;
				if (val != null && val.length >= 8) {
					var result = zxcvbn(val);
					if (val !== "") {
						text.innerHTML = "Strength: " + strength[result.score];
					} else {
						text.innerHTML = "";
					}
				} else {
					text.innerHTML = "";
				}
			});

			$("#msform").on("submit", function () {
				return true;
			})

			$('#phone').inputmask({
				mask: "99999999999",
				removeMaskOnSubmit: true,
			});

			$("#click_to_verify").on('change', function () {
				checked = this.checked;
				if (this.checked) {
					let str = $('#email').val();
					str = str.split('.').slice(1);
					const allowedDomains = ['nhs', 'ac'];
					if ($.inArray(str[0], allowedDomains) !== -1) {
						setMessage("You qualify for special discount!", 'success');
						return true;  // FAIL validation when REGEX matches
					} else {
						setMessage("Unfortunately, you don\'t qualify for special discount!", "error");
						return false;   // PASS validation otherwise
					}
				} else {
					setMessage(null, null);
				}
			});

			$('#email').keyup(function () {
				if (checked) {
					let str = $('#email').val();
					str = str.split('.').slice(1);
					const allowedDomains = ['nhs', 'ac'];
					if ($.inArray(str[0], allowedDomains) !== -1) {
						setMessage("You qualify for special discount!", 'success');
						return true;  // FAIL validation when REGEX matches
					} else {
						setMessage("Unfortunately, you don\'t qualify for special discount!", "error");
						return false;   // PASS validation otherwise
					}
				} else {
					setMessage(null, null);
				}
			});

			$('#msform').validate({
				rules: {
					first_name: {
						required: true,
					},
					last_name: {
						required: true,
					},
					phone: {
						required: true,
					},
					gender: {required: true},
					email: {
						required: true,
						email: true,
					},
					dob: {required: true},
					password: {
						required: true,
						minlength: 8,
					},
					password_confirmation: {
						required: true,
						minlength: 8,
						equalTo: password
					},
					click_to_verify: true,
				},
				messages: {
					password_confirmation: {
						equalTo: "Passwords do not match!",
					}
				}
			});

			$(document).on('click', '#register_btn', function () {
				if (!$("#msform").valid()) { // Not Valid
					return false;
				} else {

				}
			});
		});

		setMessage = (message, type) => {
			if (type === 'error') {
				$('#emailMessage').removeClass('d-none').removeClass('text-success').html(message);
			} else if (type === 'success') {
				$('#emailMessage').removeClass('d-none').addClass('text-success').html(message);
			} else {
				$('#emailMessage').addClass('d-none').removeClass('text-success').html("");
			}
		}

		$('#password').keyup(function () {

		});
	</script>
@endsection