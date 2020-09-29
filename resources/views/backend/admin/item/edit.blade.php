@extends('backend.master')

@section('title') Admin | Item | Edit @endsection

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
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Edit Item</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ url('/admin/items') }}">Item</a></li>
							<li class="breadcrumb-item active">Edit</li>
						</ol>
						<!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-info">
							<h4 class="m-b-0 text-white">Edit Item</h4>
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
							<form action="{{ route('admin.items.update',$item->id) }}" method="post" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="form-body">
									<hr>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Name*</label>
												<input type="text" name="name" id="name" class="form-control" placeholder="Enter name.." value="{{ $item->name }}" required minlength="2" maxlength="255">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Category*</label>
												<select class="form-control" id="category_id" name="category_id" required>
													<option value="">Select Category</option>
													@if(!empty($categoryList))
														@foreach($categoryList as $rows)
															<option @if($item->category_id==$rows->id) selected @endif value="{{ $rows->id }}">{{ $rows->name }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Short Description*</label>
												<input type="text" name="short_description" id="short_description" class="form-control" placeholder="Enter Short Description.." value="{{ $item->short_description }}" minlength="2" maxlength="255" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Description*</label>
												<input type="text" name="long_description" id="long_description" class="form-control" placeholder="Enter Sub name.." value="{{ $item->long_description }}" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Protein</label>
												<input type="number" name="protein" id="protein" class="form-control" placeholder="Enter protein.." min="0.00" max="10000.00" step="0.01" required value="{{old('protein',$item->protein)}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Calories </label>
												<input type="number" name="calories" id="calories" class="form-control" placeholder="Enter calories.." min="0.00" max="10000.00" step="0.01" required value="{{$item->calories}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Carbs</label>
												<input type="number" name="carbs" id="carbs" class="form-control" placeholder="Enter carbohydrates.." min="0.00" max="10000.00" step="0.01" required value="{{$item->carbs}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Fats*</label>
												<input type="number" name="fat" id="fat" class="form-control" placeholder="Enter fat.." min="0.00" max="10000.00" step="0.01" required value="{{$item->fat}}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Type*</label>
												<select class="form-control" id="item_type_id" name="item_type_id" required>
													<option value="">Choose...</option>
													@if(!empty($itemTypeList))
														@foreach($itemTypeList as $rows)
															<option @if( $item->item_type_id==$rows->id) selected @endif value="{{ $rows->id }}">{{ $rows->name }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Selling Price*</label>
												<input type="number" min="0.00" max="100000.00" step="0.01" name="selling_price" id="selling_price" class="form-control" placeholder="Enter selling price..." value="{{$item->selling_price}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Regular Price*</label>
												<input type="number" min="0.00" max="100000.00" step="0.01" name="actual_price" id="actual_price" class="form-control" placeholder="Enter regular price..." value="{{$item->actual_price}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Thumbnail</label>
												<input type="file" name="thumbnail" id="thumbnail" class="form-control" title="Select thumbnail..">
											</div>
										</div>
										@php
											$ids = (isset($item) && $item->ingredients->count() > 0 ) ? array_pluck($item->ingredients->toArray(), 'id') : null;
										@endphp
										<div class="col-md-6">
											<div class="form-group">
												<label>Ingredient(s)</label>
												<select class="form-control select2 select2-multiple" id="ingredient_id" name="ingredient_id[]" style="width: 100%" multiple="multiple" data-placeholder="Choose..." required>
													@if(!empty($listData))
														@foreach($listData as $rows)
															<option value="{{ $rows->id }}"
															@if(!is_null($ids) && in_array($rows->id, $ids))
																{{'selected'}}
																	@endif
															>{{ $rows->name }}</option>
														@endforeach
													@else
														<option value="">Select</option>
													@endif

												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save
									</button>
									<a href="{{ route('admin.items.index') }}" class="btn btn-inverse">Cancel</a>
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
			allowClear: true
		});
	</script>

@endsection
       