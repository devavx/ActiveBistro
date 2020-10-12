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
			<div class="col-lg-6 col-sm-6 col-12 mx-auto">
				<div class="alert-box card mt-5 mb-5 p-0 " style="float: none; margin: 0 auto;">
					<div class="alert alert-success mb-0" style="height: 350px; padding-top: 60px;">
						<div class="alert-icon text-center">
							<i class="fa fa-check-square-o  fa-3x" aria-hidden="true"></i>
						</div>
						<div class="alert-message text-center">
							<strong>Oops!</strong> Something went wrong with the payment.
							<p>We suggest you to try again in a while!</p>
							<a href="{{route('my_order')}}">Go to My orders</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('script')
	<script>
		$(document).ready(function () {
		});
	</script>
@endsection