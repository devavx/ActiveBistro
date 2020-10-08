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
							<h4 class="font-weight-bold text-color">Reset Your Password</h4>
							<div class="form-group">
								<label>We need your email again!</label>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
								@error('email')
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>

							<div class="form-group row">
								<label>Password</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
								@error('password')
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
								@enderror
							</div>

							<div class="form-group row">
								<label>Confirm Password</label>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
							</div>

							<div class="form-group">
								<button class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i></button>
							</div>
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