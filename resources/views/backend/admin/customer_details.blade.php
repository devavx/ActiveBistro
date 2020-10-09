@extends('backend.master')

@section('title') Admin | Customer Details @endsection

@section('style')

	<link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/loader_spin.css') }}">
	<style type="text/css">

	</style>
@endsection
@section('content')
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Profile</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
							<li class="breadcrumb-item active">Customer Profile</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- Row -->
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
			<div class="row">

				<!-- Column -->
				<div class="col-lg-4 col-xlg-3 col-md-5">
					<div class="card">
						<div class="card-body">
							<center class="m-t-30">
								<img src="@if(!empty($userRecord->profile_image)){{$userRecord->profile_image}} @else {{ asset('assets/images/users/5.jpg')}} @endif" class="img-circle" width="150"/>
								<h4 class="card-title m-t-10">{{ $userRecord->name }}</h4>
								<h6 class="card-subtitle">{{ $userRecord->role->description }}</h6>
								<!--  <div class="row text-center justify-content-md-center">
									 <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
									 <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
								 </div> -->
							</center>
						</div>
						<div>
							<hr>
						</div>
						<div class="card-body">
							<small class="text-muted">Email </small>
							<h6>{{ $userRecord->email??'-' }}</h6>
							<small class="text-muted p-t-30 db">Phone</small>
							<h6>{{ $userRecord->phone??'-' }}</h6>
							<small class="text-muted p-t-30 db">Address</small>
							<h6>{{ $userRecord->address??'-' }}</h6>
						</div>
					</div>
				</div>
				<!-- Column -->
				<!-- Column -->
				<div class="col-lg-8 col-xlg-9 col-md-7">
					<div class="card">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs profile-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a></li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#settings" role="tab">Edit</a></li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#change_password" role="tab">Change Password</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<!--second tab-->
							<div class="tab-pane active" id="profile" role="tabpanel">
								<div class="card-body">
									<div class="row">
										<div class="col-md-4 col-xs-6 b-r"><strong>First Name</strong>
											<br>
											<p class="text-muted">{{ $userRecord->first_name ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6 b-r"><strong>Last Name</strong>
											<br>
											<p class="text-muted">{{ $userRecord->last_name ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6 b-r"><strong>Full Name</strong>
											<br>
											<p class="text-muted">{{ $userRecord->name ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6 b-r"><strong>Mobile</strong>
											<br>
											<p class="text-muted">{{ $userRecord->phone ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6 b-r"><strong>Email</strong>
											<br>
											<p class="text-muted">{{ $userRecord->email ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6"><strong>Height</strong>
											<br>
											<p class="text-muted">{{ $userRecord->user_height ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6"><strong>Weight </strong>
											<br>
											<p class="text-muted">{{ $userRecord->user_weight ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6"><strong>Target Weight </strong>
											<br>
											<p class="text-muted">{{ $userRecord->user_targert_weight ?? '-' }}</p>
										</div>
										<div class="col-md-4 col-xs-6"><strong>Date of Birth </strong>
											<br>
											<p class="text-muted">{{$userRecord->dob}}, {{ $userRecord->age() }} year(s)</p>
										</div>
									</div>
									<hr>
								</div>
							</div>
							<div class="tab-pane" id="settings" role="tabpanel">
								<div class="card-body">
									<form class="form-horizontal form-material" id="admin_profile_form" action="{{ url('/admin/update_customer') }}" method="post" enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<label class="col-md-12">First Name</label>
											<div class="col-md-12">
												<input type="text" name="first_name" class="form-control form-control-line" value="{{ $userRecord->first_name }}" minlength="2" maxlength="25" required>
												<input type="hidden" name="user_id" value="{{ $userRecord->id }}">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12">Last Name</label>
											<div class="col-md-12">
												<input type="text" name="last_name" class="form-control form-control-line" value="{{ $userRecord->last_name }}" minlength="2" maxlength="25" required>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="col-md-12">Email</label>
											<div class="col-md-12">
												<input type="email" class="form-control form-control-line" name="email" id="email" value="{{ $userRecord->email }}" required minlength="2" maxlength="255">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12">Phone No</label>
											<div class="col-md-12">
												<input type="text" class="form-control form-control-line" name="phone" id="phone" value="{{ $userRecord->phone }}" minlength="8" maxlength="16" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12">Height (centimeters)</label>
											<div class="col-md-12">
												<input type="text" class="form-control form-control-line" name="user_height" id="user_height" value="{{ $userRecord->user_height }}" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12">Weight (Kilograms)</label>
											<div class="col-md-12">
												<input type="text" class="form-control form-control-line" name="user_weight" id="user_weight" value="{{ $userRecord->user_weight }}" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12">Target Weight (Kilograms)</label>
											<div class="col-md-12">
												<input type="text" class="form-control form-control-line" name="user_targert_weight" id="user_targert_weight" value="{{ $userRecord->user_targert_weight }}" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12">Profile Image</label>
											<div class="col-md-12">
												<input type="file" name="profile_image" id="profile_image" title="Select profile image.." class="form-control form-control-line" accept=".jpg, .jpeg, .png" data-default-file="{{$userRecord->profile_image}}" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<button type="submit" class="btn btn-success" id="save_profile">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="tab-pane" id="change_password" role="tabpanel">
								<div class="card-body">
									<form class="form-horizontal form-material" id="change_password_form">
										@csrf
										<div class="form-group">
											<label class="col-md-12">Current Password</label>
											<div class="col-md-12">
												<input type="password" name="current_password" id="current_password" placeholder="Current Password.." class="form-control form-control-line" minlength="8" maxlength="64">
												<input type="hidden" name="user_id" value="{{ $userRecord->id }}">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12">New Password</label>
											<div class="col-md-12">
												<input type="password" name="new_password" id="new_password" placeholder="New Password.." class="form-control form-control-line" minlength="8" maxlength="64">
											</div>
										</div>
										<div class="form-group">
											<label for="c_password" class="col-md-12">Confirm Password</label>
											<div class="col-md-12">
												<input type="text" placeholder="Confirm Password" class="form-control form-control-line" id="confirm_password" name="confirm_password" minlength="8" maxlength="64">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<button type="button" class="btn btn-success" id="change_password_btn">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="cover-spin" style="display: none;"></div>
@endsection
@section('script')
	<script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/Lobibox.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#profile_image').dropify({
				messages: {
					default: "Click to choose..."
				}
			});

			$('#admin_profile_form').validate({ // initialize the plugin
				rules: {
					name: {
						required: true,
					},
					email: {
						required: true,
						email: true,
					},
				},
			});

			$(document).on('click', '#edit_profile', function () {
				if (!$("#admin_profile_form").valid()) { // Not Valid
					return false;
				} else {
					url = "{{ url('/admin/profile/') }}";
					saveAjaxData('#admin_profile_form', url, '#edit_profile')
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
					url = "{{ url('/admin/change-password') }}";
					saveAjaxData('#change_password_form', url, '#change_password_btn')
				}
			});
		});
	</script>
@endsection