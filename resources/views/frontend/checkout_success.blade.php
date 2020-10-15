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
					<div class="alert bg-white mb-0" style="height: 350px; padding-top: 60px;">
						<div class="alert-icon alert-icon-success text-center">
							<i class="fa fa-check-square-o  fa-3x text-success" aria-hidden="true"></i>
						</div>
						<div class="alert-message text-center">
							<strong>Success!</strong>
							<p>Thank you very much for your order. You’re helping support a new local business! An order confirmation email will be emailed to you shortly with delivery information.</p>
							<a href="{{route('my_order')}}" class="text-color">Go to My orders</a>
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