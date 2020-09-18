@extends('backend.master')

@section('title') Admin | Delivery Deadline | Edit @endsection

@section('style')
	<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
	<style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000 !important;
        }

        .error {
            color: red;
        }
	</style>
@endsection
@section('content')
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Bottom Section</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item">
								<a href="{{ url('/admin/delivery_deadline') }}">Delivery Deadline</a>
							</li>
							<li class="breadcrumb-item active">Edit</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-info">
							<h4 class="m-b-0 text-white">Delivery Deadline</h4>
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
							<form action="{{ route('admin.delivery_deadline.update',$deadline->id) }}" id="add_form" method="post" enctype="multipart/form-data">
								@method('PUT')
								@csrf
								<div class="form-body">
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Deadline</label>
												<input type="datetime-local" name="deadline" id="description" class="form-control" placeholder="Enter name.." value="{{$deadline->deadline}}" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update
									</button>
									<a href="{{ url('/admin/delivery_deadline') }}" class="btn btn-inverse">Cancel</a>
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
	<script>
		$(document).ready(function () {

		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("input[name=deadline2]").datepicker({
				changeMonth: true,
				changeYear: true,
				startDate: '{{date('Y-m-d')}}',
				endDate: '+1w',
			});
			$('#add_form').validate({ // initialize the plugin
				rules: {
					description: {
						required: true,
					}
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
       