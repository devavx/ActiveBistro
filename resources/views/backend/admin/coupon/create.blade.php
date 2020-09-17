@extends('backend.master')

@section('title') Admin | Coupons | Create @endsection

@section('style')
	<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
	<style type="text/css">
        .error {
            color: red;
        }
	</style>
@endsection
@section('content')
	<div class="page-wrapper">
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Create Coupon</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/coupons') }}">Coupon</a></li>
							<li class="breadcrumb-item active">Create</li>
						</ol>
						<!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-info">
							<h4 class="m-b-0 text-white">Create Coupon</h4>
						</div>
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
						@if(count($errors) > 0 )
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<ul class="p-0 m-0" style="list-style: none;">
									@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="card-body">
							<form action="{{ route('admin.coupons.store') }}" method="post" id="add_form">
								@csrf
								<div class="form-body">
									<hr>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Code</label>
												<input type="text" name="code" id="name" class="form-control" placeholder="Enter code.." required value="{{old('code')}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Description(Optional)</label>
												<input type="text" name="description" id="description" class="form-control" placeholder="Enter Description.." value="{{old('description')}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Usage Count</label>
												<input type="number" min="1" maxlength="1000000" name="usage_count" id="usage_count" class="form-control" placeholder="Limit number of times this coupon can be used, leave blank otherwise" value="{{old('usage_count')}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Discount</label>
												<input type="number" min="1" max="100" name="discount" id="description" class="form-control" placeholder="Enter Description.." value="{{old('discount',10)}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Valid From</label>
												<input type="text" id="code" name="valid_from" class="form-control" required placeholder="Valid from date..." readonly value="{{old('valid_from')}}" style="background-color: white;">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Valid Until</label>
												<input type="text" name="valid_until" id="description" class="form-control" required placeholder="Valid until date..." readonly value="{{old('valid_until')}}" style="background-color: white;">
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" id="add_btn" class="btn btn-success">
										<i class="fa fa-check"></i> Save
									</button>
									<a href="{{ route('admin.coupons.index') }}" class="btn btn-inverse">Cancel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			$("input[name=valid_from]").datepicker({
				changeMonth: true,
				changeYear: true,
				startDate: '{{date('Y-m-d')}}',
				endDate: '+1y',
			});

			$("input[name=valid_until]").datepicker({
				changeMonth: true,
				changeYear: true,
				startDate: '{{date('Y-m-d',time()+86400)}}',
				endDate: '+1y',
			});

			$('#add_form').validate({ // initialize the plugin
				rules: {
					code: {
						required: true,
					},
				}
			});

			$(document).on('click', '#edit_profile', function () {
				if (!$("#add_form").valid()) { // Not Valid
					return false;
				} else {

				}
			});
		});
	</script>
@endsection
       