@extends('layouts.master')
@section('title') User | Login  @endsection
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
					<form method="POST" action="{{ route('login') }}">
						@csrf

						<h4 class="font-weight-bold text-color">Customer Login</h4>
						<div class="form-group">
							<label>Email ID <small class="text-color">Username</small></label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class="form-group">
							<label>Password</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
							<p class="text-right">
								<a href="{{route('password.request')}}" class="text-color">Forgot Password</a></p>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

									<label class="form-check-label" for="remember">
										{{ __('Remember Me') }}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i>
							</button>
						</div>

						<div class="form-group">
							<p>Don't have an account?
								<a href="{{ url('sign-up') }}" class="text-color">Create Account</a></p>
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