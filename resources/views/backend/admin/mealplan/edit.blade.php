@extends('backend.master')

@section('title') Admin | Meal Plan | Edit @endsection

@section('style')
	<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
	<style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000 !important;
        }

	</style>
@endsection
@section('content')
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Edit Meal Plan</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/meals') }}">Meal Plan</a>
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
							<h4 class="m-b-0 text-white">Edit Meal Plan</h4>
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
							<form action="{{ route('admin.meals.update',$mealplan->id) }}" method="post" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="form-body">
									<hr>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Meal Plan</label>
												<input type="text" name="name" class="form-control" placeholder="Enter Meal Plan name.." value="{{ $mealplan->name }}">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Item</label>
											<select class="form-control select2 select2-multiple" id="item_id" name="item_id[0][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
												@if(!empty(@listData))
													@foreach($listData as $rows)
														<option value="{{ $rows->id }}" @if(in_array($rows->id,$bound[0])) selected @endif>{{ $rows->name }}</option>
													@endforeach
												@else
													<option value="">Select</option>
												@endif
											</select>
											<select class="form-control select2 select2-multiple" id="item_id_1" name="item_id[1][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
												@if(!empty(@listData))
													@foreach($listData as $rows)
														<option value="{{ $rows->id }}" @if(in_array($rows->id,$bound[1])) selected @endif>{{ $rows->name }}</option>
													@endforeach
												@else
													<option value="">Select</option>
												@endif
											</select>
											<select class="form-control select2 select2-multiple" id="item_id_2" name="item_id[2][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
												@if(!empty(@listData))
													@foreach($listData as $rows)
														<option value="{{ $rows->id }}" @if(in_array($rows->id,$bound[2])) selected @endif>{{ $rows->name }}</option>
													@endforeach
												@else
													<option value="">Select</option>
												@endif
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Coming Soon</label>
											&nbsp;&nbsp;&nbsp;<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Check this box if you want to add meal in comign soon">
  <label class="badge badge-light btn btn-success" style="pointer-events: none;" type="button" disabled>?</label>
</span><br>
											<input type="checkbox" name="launched" @if($mealplan->launched==true) checked @endif/>
										</div>
									</div>
								</div>
								@include('backend.fragments.gallery.gallery-view',['images'=>$mealplan->images->toArray()])
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
	<script type="text/javascript">
        $(".select2").select2({
            placeholder: "Please select Item",
            allowClear: true
        });
        $(document).ready(function () {
			@include('backend.fragments.gallery.gallery-js',['prefix'=>'/admin/daily-meals/images/'.$mealplan->id])
            $(".select2").addClass('mb-2');
        });
	</script>
@endsection
       