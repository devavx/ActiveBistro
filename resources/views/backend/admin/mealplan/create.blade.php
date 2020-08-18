@extends('backend.master')

@section('title') Admin | Meals | Create @endsection

@section('style')
	<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
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
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Create Meal</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/meals') }}">Meal Plans</a></li>
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
							<h4 class="m-b-0 text-white">Create Meal</h4>
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
										<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="card-body">
							<form action="{{ route('admin.meals.store') }}" method="post" id="add_form" enctype="multipart/form-data">
								@csrf
								<div class="form-body">
									<!--  <h3 class="card-title">Person Info</h3>
									 <hr>
									   -->

									<!--/row-->
									<!-- <h3 class="box-title m-t-40">Address</h3> -->
									<hr>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Meal Plan</label>
												<input type="text" name="name" id="name" class="form-control" placeholder="Enter meal plan name...">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Type</label>
												<select class="form-control" name="type" id="no_of_days">
													<option value="" disabled selected>Choose...</option>
													@foreach(\App\Core\Enums\Common\MealTypes::getKeys() as $type)
														<option value="{{ \App\Core\Enums\Common\MealTypes::getValue($type) }}">{{ $type }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Item(s)</label>
											<select class="form-control select2 select2-multiple" id="item_id" name="item_id[0][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
												<option value="" disabled>Choose...</option>
												@foreach($listData as $rows)
													<option value="{{ $rows->id }}">{{ $rows->name }}</option>
												@endforeach
											</select>
											<select class="form-control select2 select2-multiple" id="item_id_1" name="item_id[1][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
												<option value="" disabled>Choose...</option>
												@foreach($listData as $rows)
													<option value="{{ $rows->id }}">{{ $rows->name }}</option>
												@endforeach
											</select>
											<select class="form-control select2 select2-multiple" id="item_id_2" name="item_id[2][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
												<option value="" disabled>Choose...</option>
												@foreach($listData as $rows)
													<option value="{{ $rows->id }}">{{ $rows->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Coming soon (not launched yet)?</label>
											&nbsp;&nbsp;&nbsp;<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Check this box if you want to add meal in coming soon">
  <label class="badge badge-light btn btn-success" style="pointer-events: none;" type="button" disabled>?</label>
</span><br>
											<input type="checkbox" name="launched">
										</div>
									</div>
								</div>
								@include('backend.fragments.gallery.gallery-view')
								<div class="form-actions">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save
									</button>
									<a href="{{ route('admin.meals.index') }}" class="btn btn-inverse">Cancel</a>
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
	<script type="text/javascript" src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">
        $(".select2").select2({
            placeholder: "Choose...",
            allowClear: true
        });
        $(document).ready(function () {
			@include('backend.fragments.gallery.gallery-js')
            $(".select2").addClass('mb-2');
            $('#add_form').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true,
                    },
                    // no_of_days: {
                    //     required: true,               
                    // },rate_per_item: {
                    //     required: true,               
                    // },meal_in_three_days: {
                    //     required: true,               
                    // },meal_in_two_days: {
                    //     required: true,               
                    // },rate_per_item_three_days: {
                    //     required: true,               
                    // },
                    "item_id[]": "required",
                },
                messages: {
                    "item_id[]": {
                        required: 'Please select at least one.'
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
       