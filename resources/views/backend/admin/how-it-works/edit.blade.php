@extends('backend.master')

@section('title') Admin | How It Work | Edit @endsection

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
					<h4 class="text-themecolor">How It Work</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/how_it_works') }}">How It Work</a></li>
							<li class="breadcrumb-item active">Edit</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-info">
							<h4 class="m-b-0 text-white">How It Work</h4>
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
							<form action="{{ route('admin.how_it_works.update',$howItWork->id) }}" id="add_form" method="post" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="form-body">
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Image*</label>&nbsp;&nbsp;&nbsp;<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Recommended size of icon is 256*256 (1:1), you can use a larger image, but the dimensions should grow proportionally. Use a PNG or JPG.">
  <label class="badge badge-light btn btn-success" style="pointer-events: none;" type="button" disabled>?</label>
</span>
												<input type="file" name="title" id="title" class="form-control" placeholder="Choose an icon..." accept=".jpg, .jpeg, .png">
												<small>Choose new to overwrite existing.</small>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="title">Title*</label>
												<input type="text" name="title" id="title" minlength="2" maxlength="255" placeholder="Enter title..." class="form-control">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>How It Work</label>
												<textarea type="text" name="description" id="description" class="form-control" placeholder="Enter description..">{{ $howItWork->description }}</textarea>
											</div>
										</div>

									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save
									</button>
									<a href="{{ url('/admin/postal_codes') }}" class="btn btn-inverse">Cancel</a>
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
					toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink | print preview fullpage | forecolor backcolor emoticons",
					menubar: false
				});
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {

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
       