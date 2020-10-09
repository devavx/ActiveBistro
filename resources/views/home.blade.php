@extends('layouts.master')
@section('title') Active Bistro | My Profile @endsection
@section('css')
	<link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/loader_spin.css') }}">
	<link href="{{ asset('assets/node_modules/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<style type="text/css">
        .error {
            color: red;
        }
	</style>
@endsection
@section('content')
	<div class="container mt-3 mb-5">
		<div class="row">
			<div class="col-lg-8 col-sm-8 col-12">
				<div class="myprofiledetail mt-3 shadow p-3">
					@if($message=Session::get('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong> {{$message}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif

					@if($errormessage=Session::get('errormsg'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong> {{$errormessage}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					<h5 class="font-weight-bold text-color">Personal Details</h5>
					<hr>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-12">
							<label>First Name</label>
							<p class="text-color">{{ auth()->user()->first_name ?? '-'  }}</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Last Name</label>
							<p class="text-color">{{ auth()->user()->last_name ?? '-'  }}</p>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<label>Email Address</label>
							<p class="text-color">{{ auth()->user()->email ?? '-'  }}</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Phone</label>
							<p class="text-color">{{ auth()->user()->phone ?? '-'  }}</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Address</label>
							<p class="text-color">{{ auth()->user()->address ?? '-'  }}</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Shipping Address</label>
							<p class="text-color">{{ auth()->user()->about ?? '-'  }}</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Height</label>
							<p class="text-color">{{ auth()->user()->user_height ?? '-'  }}</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Weight</label>
							<p class="text-color">{{ auth()->user()->user_weight ?? '-'  }}</p>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<label>Target Weight</label>
							<p class="text-color">{{ auth()->user()->user_targert_weight ?? '-' }}</p>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<label>Date of Birth, Age</label>
							@if(!empty(auth()->user()->dob))
								<p class="text-color">{{auth()->user()->dob}}, {{ auth()->user()->age() }} year(s)</p>
							@else
								<p class="text-color">-</p>
							@endif
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<label>Activity Level</label>
							<p class="text-color">{{ auth()->user()->activity_lavel }}</p>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<label>Preferred Diet Type</label>
							<p class="text-color">{{ \App\Core\Enums\Common\DietType::getKey(auth()->user()->diet_type) }}</p>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<h6 class="text-color font-weight-bold">Recommended</h6>
							@php
								$userGender = Auth::user()->gender ?? 'male';
								$weightInKG = Auth::user()->user_weight ?? '1';
								$heighIntCM = Auth::user()->user_height ?? '1';
								$age = getAge(Auth::user()->dob, date('Y-m-d'))
							@endphp
							<table class="table table-striped table-bordered">
								<tr class="text-center">
									<th class="p-2 w-50">Calories</th>
									<td class="p-2 w-50" colspan="2">{{ auth()->user()->calories() }} kcal</td>
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
						<div class="col-lg-6 col-sm-6 col-12">
							<h6 class="text-color font-weight-bold">Desired Weekly Progress</h6>
							@if(auth()->user()->unit_system==\App\Core\Enums\Common\UnitSystem::Metric)
								@if(auth()->user()->weekly_progress>0)
									<p class="text-color">Gain {{abs(auth()->user()->weekly_progress)}} KG per week</p>
								@elseif(auth()->user()->weekly_progress<0)
									<p class="text-color">Lose {{abs(auth()->user()->weekly_progress)}} KG per week</p>
								@else
									<p class="text-color">Maintain weight</p>
								@endif
							@else
								@if(auth()->user()->weekly_progress>0)
									<p class="text-color">Gain {{abs(auth()->user()->weekly_progress)}} LB per week</p>
								@elseif(auth()->user()->weekly_progress<0)
									<p class="text-color">Lose {{abs(auth()->user()->weekly_progress)}} LB per week</p>
								@else
									<p class="text-color">Maintain weight</p>
								@endif
							@endif
						</div>
					</div>

						<button class="btn btn-info ml-0" data-toggle="modal" data-target="#changedetail">Change Information</button>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="change-password p-3 shadow mt-3">
					<h5 class="font-weight-bold text-color">Change Password</h5>
					<hr>

					<form id="change_password_form">
						@csrf
						<div class="form-group">
							<label>Enter current password</label>
							<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password..." minlength="8" maxlength="64">
						</div>

						<div class="form-group">
							<label>Enter new password</label>
							<input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password..." minlength="8" maxlength="64">
						</div>

						<div class="form-group">
							<label>Confirm password</label>
							<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password..." minlength="8" maxlength="64">
						</div>

						<div class="form-group mb-0">
							<button type="button" id="change_password_btn" class="btn btn-info ml-0">Change</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade right shadow" id="changedetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog  modal-full-height modal-right" role="document">
			<div class="modal-content">
				<div class="modal-header bg-color ">
					<h5 class="modal-title w-100 text-white">Change Personal Detail</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-white">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="{{ route('update_user') }}" id="msform" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label>First Name <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}" required autocomplete="first_name" autofocus minlength="2" maxlength="25">
						</div>
						<div class="form-group">
							<label>Last Name <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}" required autocomplete="last_name" minlength="2" maxlength="25">
						</div>
						<div class="form-group">
							<label>Email Address <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" required autocomplete="email" readonly maxlength="100">
						</div>

						<div class="form-group">
							<label>Phone <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" required autocomplete="phone" value="{{ Auth::user()->phone }}" minlength="8" maxlength="16">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-6">
									<label>Height <sup class="text-danger">*</sup></label>
									<input type="number" min="1.0" max="400.0" step="1.0" class="form-control" name="user_height" id="user_height" value="{{ Auth::user()->user_height }}" required>
								</div>
								<div class="col-6">
									<label>Unit System <sup class="text-danger">*</sup></label>
									<div class="custom-control custom-switch">
										<input type="hidden" name="unit_system" value="metric">
										<input type="checkbox" class="custom-control-input" id="unit_system_switch" value="metric" onchange="handleSwitchChange();">
										<label class="custom-control-label" for="unit_system_switch" id="unit_system_switch_label">Metric</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-6">
									<label>Weight <sup class="text-danger">*</sup></label>
									<input type="number" min="1.0" max="350.0" step="1.0" class="form-control" name="user_weight" id="user_weight" value="{{ Auth::user()->user_weight }}" required>
								</div>
								<div class="col-6">
									<label>Target Weight <sup class="text-danger">*</sup></label>
									<input type="number" min="1.0" max="400.0" step="1.0" class="form-control" name="user_targert_weight" id="user_targert_weight" value="{{ Auth::user()->user_targert_weight }}" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Activity Level <sup class="text-danger">*</sup></label>
							<select class="form-control" name="activity_lavel" id="activity_lavel" required>
								<option value="" selected disabled>Select</option>
								<option value="{{\App\Core\Enums\Common\ActivityLevel::Sedentary}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\ActivityLevel::Sedentary) selected @endif>1 - Sedentary</option>
								<option value="{{\App\Core\Enums\Common\ActivityLevel::Light}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\ActivityLevel::Light) selected @endif>2 - Lightly Active</option>
								<option value="{{\App\Core\Enums\Common\ActivityLevel::Moderate}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\ActivityLevel::Moderate) selected @endif>3 - Moderately Active</option>
								<option value="{{\App\Core\Enums\Common\ActivityLevel::Very}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\ActivityLevel::Very) selected @endif>4 - Very Active</option>
								<option value="{{\App\Core\Enums\Common\ActivityLevel::Extra}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\ActivityLevel::Extra) selected @endif>5 - Extra Active</option>
								<option value="{{\App\Core\Enums\Common\ActivityLevel::Athlete}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\ActivityLevel::Athlete) selected @endif>6 - Professional Athlete</option>
							</select>
						</div>
						<div class="form-group">
							<label>Preferred Diet Type <sup class="text-danger">*</sup></label>
							<select class="form-control" name="diet_type" required>
								<option value="" selected disabled>Select</option>
								<option value="{{\App\Core\Enums\Common\DietType::Regular}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\DietType::Regular) selected @endif>Regular</option>
								<option value="{{\App\Core\Enums\Common\DietType::Ketogenic}}" @if(auth()->user()->activity_lavel==\App\Core\Enums\Common\DietType::Ketogenic) selected @endif>Ketogenic</option>
							</select>
						</div>
						<div class="form-group">
							<label>Profile Image</label>
							<input type="file" name="profile_image" id="profile_image" title="Choose..." class="form-control form-control-line" accept=".jpg, .jpeg, .png" data-default-file="{{auth()->user()->profile_image}}" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="cover-spin" style="display: none;"></div>
@endsection
@section('script')
	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/Lobibox.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets/node_modules/dropify/dist/js/dropify.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#profile_image').dropify({
				messages: {
					default: "Click to choose..."
				}
			});

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
					first_name: {required: true,},
					last_name: {required: true,},
					email: {
						required: true,
						email: true,
					},
					address: {required: true,},
					about: {required: true,},
				},
			});

			$(document).on('click', '#register_btn', function () {
				if (!$("#msform").valid()) { // Not Valid
					return false;
				} else {

				}
			});

			$('#change_password_form').validate({ // initialize the plugin
				rules: {
					current_password: {
						required: true,
						minlength: 8
					},
					new_password: {
						required: true,
						minlength: 8
					},
					confirm_password: {
						required: true,
						equalTo: new_password
					},
				},
				messages: {
					confirm_password: {
						equalTo: "Passwords do not match!",
					}
				}
			});

			$(document).on('click', '#change_password_btn', function () {
				if (!$("#change_password_form").valid()) { // Not Valid
					return true;
				} else {
					url = "{{ url('/change_password') }}";
					saveAjaxData('#change_password_form', url, '#change_password_btn')
				}
			});
		})
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})

		function handleSwitchChange() {
			if (event.currentTarget.checked) {
				$('#unit_system_switch_label').html('Imperial');
				$('input[name=unit_system]').val('imperial');
			} else {
				$('#unit_system_switch_label').html('Metric');
				$('input[name=unit_system]').val('metric');
			}
		}
	</script>
@endsection