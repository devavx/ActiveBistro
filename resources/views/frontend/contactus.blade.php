@extends('layouts.master')
@section('title') Active Bistro | Cantact Us @endsection
@section('csss') 
<style type="text/css"></style>
@endsection
@section('content') 
	<div class="container mb-5">
		<div class="row">
			<div class="col-lg-8 col-sm-12 col-12">
				<h4 class="font-weight-bold text-color mt-5">Contact Us</h4>

				<div class="row">
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>First Name</label>
							<input type="text" class="form-control">
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" class="form-control">
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Email ID</label>
							<input type="email" class="form-control">
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="form-group">
							<label>Phone Number</label>
							<input type="text" class="form-control">
						</div>
					</div>

					<div class="col-lg-12 col-sm-12 col-12">
						<div class="form-group">
							<label>Message</label>
							<textarea class="form-control" rows="5"></textarea>
						</div>
					</div>

					<div class="col-12">
						<button class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i></button>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-sm-12 col-12">
				<div class="card bg-color mt-5">
					<div class="card-body">
						<h6 class="font-weight-bold text-white mb-0">Email ID</h6>
						<p><a href="#" class="text-white">{{ $recordData->email ?? 'info@activebistro.com' }}</a></p>

						<h6 class="font-weight-bold text-white mb-0">Phone Number</h6>
						<p><a href="#" class="text-white">{{ $recordData->phone ?? '8989898898' }}</a></p>

						<h6 class="font-weight-bold text-white mb-0">Office Number</h6>
						<p><a href="#" class="text-white">{{ $recordData->office_number ?? '8809090090' }}</a></p>

						<h6 class="font-weight-bold text-white mb-0">Address</h6>
						<p class="text-white"> {{ @$recordData->address ?? 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.' }}</p>

						<hr>
						<!-- <p class="text-white"></p> -->
						
						<!-- <h5 class="text-white">Alternatively call our customer service team on--</h5> -->

						<div class="text-white" id="description___1" style="color: white !important"> {!! $recordData->description !!}</div>
						<!-- <p class="text-white mb-1">Suturday 9am to 4pm</p>
						<p class="text-white mb-1">Sunday 10am to 2pm</p>

						<p class="text-white mb-1">Please note we are closed on bank holidays.</p>
 -->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')

<script type="text/javascript">
	 
	$('#description___1').find('*').addClass('text-white');
</script>
@endsection


