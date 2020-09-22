@extends('backend.master')

@section('title') Admin | FAQ Categories | Create @endsection

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
					<h4 class="text-themecolor">FAQ Categories</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/faq-categories') }}">FAQ Categories</a>
							</li>
							<li class="breadcrumb-item active">Create</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-info">
							<h4 class="m-b-0 text-white">FAQ Categories List</h4>
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
							<form action="{{ route('admin.faq-categories.store') }}" id="add_form" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-body">
									<hr>
									<div id="faq_section">
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label>Title</label>
													<input type="text" name="title" id="faq_title" class="form-control" placeholder="Enter title.." required maxlength="255" minlength="1">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save
									</button>
									<a href="{{ route('admin.faq-categories.index') }}" class="btn btn-inverse">Cancel</a>
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

			if ($("#name").length > 0) {
				tinymce.init({
					selector: "textarea#name",
					theme: "modern",
					height: 300,
					plugins: [
						"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
						"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
						"save table contextmenu directionality emoticons template paste textcolor"
					],
					toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

				});
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {

			$('#add_form').validate({ // initialize the plugin
				rules: {
					title: {
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

			// Add More Faq faq_section
			var i = 1;
			$(document).on('click', '#faq_section #add_more', function () {
				i = i + 1;
				var html = '';
				html += '<div class="row remove_faq_' + i + '" id="remove_faq_' + i + '"><div class="col-md-5"><div class="form-group"><label>Title</label><input type="text" name="faq_title[]" id="faq_title" class="form-control" placeholder="Enter Title.."></div></div><div class="col-md-5"><div class="form-group"><label>Deacription</label><textarea type="text" name="faq_description[]" id="faq_description" class="form-control" placeholder="Enter Description..">Faqs</textarea></div></div><div class="col-md-2" style="margin-top: 28px;"><button type="button" name="add_more" id="add_more" class="btn btn-danger" title="Remove" onclick="removeFaq(' + i + ')">-</button></div></div>';
				$('#faq_section').append(html);
			});


		});

		function removeFaq(id) {
			$('.remove_faq_' + id).remove();
		}
	</script>
@endsection
       