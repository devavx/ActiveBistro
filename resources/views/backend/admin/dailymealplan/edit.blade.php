@extends('backend.master')

@section('title') Admin | Daily Meals | Edit @endsection

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
					<h4 class="text-themecolor">Edit Daily Meal</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/daily-meals') }}">Daily Meals</a>
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
							<h4 class="m-b-0 text-white">Edit Daily Meal</h4>
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
							<form action="{{ route('admin.daily-meals.update',$mealplan->id) }}" method="post" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="form-body">
									<hr>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input type="text" name="name" class="form-control" placeholder="Enter meal name.." value="{{ $mealplan->name }}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Day of Week</label>
												<select class="form-control" name="day" id="no_of_days" required>
													<option value="" disabled selected>Choose...</option>
													@foreach(\App\Core\Enums\Common\DaysOfWeek::getValues() as $day)
														<option value="{{$day}}" @if($mealplan->day==$day) selected @endif>{{\App\Core\Enums\Common\DaysOfWeek::getKey($day)}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Type</label>
												<select class="form-control" name="type" id="no_of_days">
													<option value="" selected>Choose...</option>
													@foreach(\App\Core\Enums\Common\MealTypes::getValues() as $type)
														<option value="{{$type}}" @if($mealplan->type==$type) selected @endif>{{\App\Core\Enums\Common\MealTypes::getKey($type)}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-9">
												<div class="form-group">
													<label>Item(s)</label>
													<select class="form-control select2 select2-multiple" id="items_slab_1" name="item_id[0][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
														@if(!empty(@listData))
															@foreach($listData as $rows)
																<option value="{{ $rows->id }}" @if(in_array($rows->id,$bound[0])) selected @endif>{{ $rows->name }}</option>
															@endforeach
														@else
															<option value="">Select</option>
														@endif
													</select>
													<select class="form-control select2 select2-multiple" id="items_slab_2" name="item_id[1][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
														@if(!empty(@listData))
															@foreach($listData as $rows)
																<option value="{{ $rows->id }}" @if(in_array($rows->id,$bound[1])) selected @endif>{{ $rows->name }}</option>
															@endforeach
														@else
															<option value="">Select</option>
														@endif
													</select>
													<select class="form-control select2 select2-multiple" id="items_slab_3" name="item_id[2][]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
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
											<div class="col-md-3">
												<div class="form-group">
													<label>Default Item(s)</label>
													<select class="form-control single-dd" name="default_slab_1" id="item_slab_1" style="width: 100%">
														@if(!empty(@listData))
															@foreach($listData as $rows)
																@if(in_array($rows->id,$bound[0]))
																	<option value="{{ $rows->id }}" @if($rows->default==true) selected @endif>{{ $rows->name }}</option>
																@endif
															@endforeach
														@else
															<option value="">Select</option>
														@endif
													</select>
													<select class="form-control single-dd" name="default_slab_2" id="item_slab_2" style="width: 100%">
														@if(!empty(@listData))
															@foreach($listData as $rows)
																@if(in_array($rows->id,$bound[1]))
																	<option value="{{ $rows->id }}" @if($rows->default==true) selected @endif>{{ $rows->name }}</option>
																@endif
															@endforeach
														@else
															<option value="">Select</option>
														@endif
													</select>
													<select class="form-control single-dd" name="default_slab_3" id="item_slab_3" style="width: 100%">
														@if(!empty(@listData))
															@foreach($listData as $rows)
																@if(in_array($rows->id,$bound[2]))
																	<option value="{{ $rows->id }}" @if($rows->default==true) selected @endif>{{ $rows->name }}</option>
																@endif
															@endforeach
														@else
															<option value="">Select</option>
														@endif
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Coming Soon</label>
											&nbsp;&nbsp;&nbsp;<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Check this box if you want to add meal in coming soon">
  <label class="badge badge-light btn btn-success" style="pointer-events: none;" type="button" disabled>?</label>
</span><br>
											<input type="checkbox" name="launched" @if($mealplan->launched==true) checked @endif/>
										</div>
										<div class="form-group">
											<label>Allergy(s)</label>
											<select class="form-control select2 select2-multiple" id="items_allergy" name="allergy_id[]" style="width: 100%" multiple="multiple" data-placeholder="Please Select">
												<option value="" disabled>Choose...</option>
												@foreach($allergies as $allergy)
													<option value="{{ $allergy->id }}" @if(in_array($allergy->id,$boundAllergies)) selected @endif>{{ $allergy->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								@include('backend.fragments.gallery.gallery-view',['images'=>$mealplan->images->toArray()])
								<div class="form-actions">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save
									</button>
									<a href="{{ route('admin.daily-meals.index') }}" class="btn btn-inverse">Cancel</a>
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
		let itemsFirstSlab = null;
		let itemsSecondSlab = null;
		let itemsThirdSlab = null;
		let itemFirstSlab = null;
		let itemSecondSlab = null;
		let itemThirdSlab = null;
		$(document).ready(function () {
			@include('backend.fragments.gallery.gallery-js',['prefix'=>'/admin/daily-meals/images/'.$mealplan->id])
			const base = {
				placeholder: "Choose...",
				allowClear: true
			};
			const baseNoPlaceHolder = {
				allowClear: false
			};
			itemsFirstSlab = $('#items_slab_1').select2(base);
			itemsSecondSlab = $('#items_slab_2').select2(base);
			itemsThirdSlab = $('#items_slab_3').select2(base);
			itemFirstSlab = $('#item_slab_1').select2(baseNoPlaceHolder);
			itemSecondSlab = $('#item_slab_2').select2(baseNoPlaceHolder);
			itemThirdSlab = $('#item_slab_3').select2(baseNoPlaceHolder);
			$('#items_allergy').select2(base);
			itemsFirstSlab.on('change', function (e) {
				itemFirstSlab.html('').select2({
					data: [{
						id: '',
						text: ''
					}]
				});
				itemFirstSlab.select2({data: itemsFirstSlab.select2('data')});
			});
			itemsSecondSlab.on('change', function (e) {
				itemSecondSlab.html('').select2({
					data: [{
						id: '',
						text: ''
					}]
				});
				itemSecondSlab.select2({data: itemsSecondSlab.select2('data')});
			});
			itemsThirdSlab.on('change', function (e) {
				itemThirdSlab.html('').select2({
					data: [{
						id: '',
						text: ''
					}]
				});
				itemThirdSlab.select2({data: itemsThirdSlab.select2('data')});
			});
			$(".select2").addClass('mb-2');
			$(".single-dd").addClass('mb-1');
		});
	</script>
@endsection
       