@extends('backend.master')

@section('title') Admin | Contact Us | Create @endsection

@section('style')
	<link href="{{ asset('assets/node_modules/html5-editor/bootstrap-wysihtml5.css') }}" type="text/css"/>
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
					<h4 class="text-themecolor">Contact Us</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/how_it_works') }}">Contact Us</a></li>
							<li class="breadcrumb-item active">Create</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-info">
							<h4 class="m-b-0 text-white">Contact Us</h4>
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
							<form action="{{ url('/admin/contact_us/save') }}" id="add_form" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-body">
									<hr>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" id="email" class="form-control" placeholder="Enter email.." value="{{ @$recordData->email }}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone.." value="{{ @$recordData->phone }}" minlength="8" maxlength="16">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Office Number</label>
												<input type="text" name="office_number" id="office_number" class="form-control" placeholder="Enter office number.." value="{{ @$recordData->office_number }}" minlength="8" maxlength="16">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Address</label>
												<textarea type="text" rows="4" name="address" id="address" class="form-control" placeholder="Enter address.." minlength="2" maxlength="255">{{ @$recordData->address }}</textarea>
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>
												<textarea type="text" rows="4" name="description" id="description" class="form-control" placeholder="Enter description..." minlength="2" maxlength="500">{!! @$recordData->description !!}</textarea>
											</div>
										</div>

									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save
									</button>
									<a href="{{ url('/admin/contact_us') }}" class="btn btn-inverse">Cancel</a>
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
	<script type="text/javascript" src="{{ asset('assets/node_modules/tinymce/tinymce.min.js') }}"></script>

	<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script>
		$(document).ready(function () {

			if ($("#description").length > 0) {
				tinymce.init({
					selector: "textarea#description",
					theme: "modern",
					height: 300,
					plugins: [
						"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
						"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
						"save table contextmenu directionality emoticons template paste textcolor"
					],
					toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink  | print preview fullpage | forecolor backcolor emoticons",
					menubar: false,
					branding: false
				});
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {

			$('#add_form').validate({ // initialize the plugin
				rules: {
					email: {
						required: true,
					},
					phone: {
						required: true,
					},
					office_number: {
						required: true,
					},
					address: {
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
       