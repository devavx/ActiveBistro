@extends('layouts.master')
@section('title') Customer | Password Recovery  @endsection
@section('css')
	<style type="text/css">

	</style>
@endsection
@section('content')
	<div class="signinpage">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-sm-6 col-12 ml-auto p-0">
					<div class="login-form shadow p-5 bg-white">
						<form method="POST" action="{{ route('password.update') }}">
							@csrf
							<input type="hidden" name="token" value="{{ $token }}">
							@if (session('status'))
								<h4 class="font-weight-bold text-color">Reset Your Password</h4>
								<div class="form-group">
									<label>{{session('status')}}</label>
								</div>
								<div class="form-group">
									<a class="btn btn-info btn-link m-0" href="{{route('sign-in')}}">Click here to go to the sign-in page.</a>
								</div>
							@else
								<h4 class="font-weight-bold text-color">Reset Your Password</h4>
								<div class="form-group">
									<label>We need your email again!</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus maxlength="100">
									@error('email')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>

								<div class="form-group">
									<label>Password</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" minlength="8" maxlength="64">
									@error('password')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>

								<div class="form-group">
									<label>Confirm Password</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" minlength="8" maxlength="64">
								</div>

								<div class="form-group">
									<button class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i>
									</button>
								</div>
							@endif
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection