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
						<form method="POST" action="{{ route('password.email') }}">
							@csrf
							@if (session('status'))
								<h4 class="font-weight-bold text-color">Reset Your Password</h4>
								<div class="form-group">
									<label>{{session('status')}}</label>
								</div>
								<div class="form-group">
									<a class="btn btn-info btn-link m-0" href="{{route('index')}}">Click here to go to the homepage</a>
								</div>
							@else
								<h4 class="font-weight-bold text-color">Reset Your Password</h4>
								<div class="form-group">
									<label>Please enter the email associated with your account</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									@error('email')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
								<div class="form-group">
									<button class="btn btn-info m-0">Submit <i class="fa fa-chevron-right ml-2"></i>
									</button>
								</div>
						</form>
						@endif
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