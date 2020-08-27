@extends('backend.master')

@section('title') Admin | Meals @endsection

@section('style')
	<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}"/>

	<link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/loader_spin.css') }}">
	<style type="text/css">


	</style>
@endsection
@section('content')

	<!-- ============================================================== -->
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
					<h4 class="text-themecolor">Meal Plans</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item active">Meal Plans</li>
						</ol>
						<a href="{{ route('admin.meals.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
									class="fa fa-plus-circle"></i> Create New</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Meal List</h4>
							<div class="text-right">
								<button class="btn btn-primary mr-4" type="button" onclick="confirmDeleteBulk();">
									<i class="fa fa-trash mr-2"></i>Delete
								</button>
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
							<div class="table-responsive m-t-40">
								<table id="example23"
								       class="display nowrap table table-hover table-striped table-bordered"
								       cellspacing="0" width="100%">
									<thead>
									<tr>
<th scope="col" class="border">
											<label><input type="checkbox" id="check_all" data-tablesaw-checkall><span class="sr-only"> Check All</span></label>
										</th>
										<th>Sr. No.</th>
										
										<th>Name</th>
										<th>Type</th>
										<th>Image(s)</th>
										<th>Status</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									@foreach($plans as $plan)
										<tr>
<td>
												<label><input type="checkbox" name="delete_target" value="{{$plan->id}}"><span class="sr-only"> Select Row </span></label>
											</td>
											<td>{{$loop->index+1}}</td>
											
											<td><a href data-toggle="modal" data-target="#detailmodal"> {{\App\Core\Primitives\Str::placeholder($plan->name)}}</a></td>
											<td> {{!empty($plan->type)?\App\Core\Enums\Common\MealTypes::getKey($plan->type):\App\Core\Primitives\Str::Empty}}</td>
											<td>
												@foreach($plan->images as $image)
													<img src="{{ $image->file }}" alt="image" width="100">
												@endforeach
											</td>
											@if($plan->active)
												<td>
													<button type="button" title="Click for Inactive" class="btn btn-success change_status" id="{{ $plan->id }}" data-id="{{ $plan->active }}">
														Active
													</button>
												</td>
											@else
												<td>
													<button type="button" title="Click for Active" class="btn btn-danger change_status" id="{{ $plan->id }}" data-id="{{ $plan->active }}">
														Inactive
													</button>
												</td>
											@endif
											<td> {{ changeDateFormat($plan->created_at,'M-d-Y') }}</td>
											<td style="text-align: center; ">
												<a class="like" href="javascript:void(0);" onclick="showMealPlan({{$plan->id}});" title="View"><i class="fas fa-search text-primary"></i></a>
												/
												<a class="like" href="{{ route('admin.meals.edit',$plan->id) }}" title="Edit"><i class="fas fa-edit text-info"></i></a>
												/
												<a class="remove" href="javascript:void(0)" onclick="confirmDelete({{ $plan->id }})" title="Remove"><i class="fas fa-trash text-danger"></i></a>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Meal Plan Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-0" id="plan_details">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div> -->
	<div id="cover-spin" style="display: none;"></div>

<div class="modal" id="detailmodal" tabindex="-1" role="dialog">
	  	<div class="modal-dialog modal-xl" role="document">
	     	<div class="modal-content">
	      		<div class="modal-header">
	        		<h4 class="modal-title">Meal Detail</h4>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	       			</button>
	      		</div>
	      		<div class="modal-body">
	        		<div class="row">
	        			<div class="col-lg-6 col-sm-6 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-3 col-sm-3 col-12">Name</label>
	        					<div class="col-lg-9 col-sm-9 col-12">
	        						<p>Spicy Salad</p>
	        					</div>
	        				</div>
	        			</div>

	        			<div class="col-lg-6 col-sm-6 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-3 col-sm-3 col-12">Type</label>
	        					<div class="col-lg-9 col-sm-9 col-12">
	        						<p>Snacks</p>
	        					</div>
	        				</div>
	        			</div>

	        			<div class="col-lg-6 col-sm-6 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-3 col-sm-3 col-12">Item(s)</label>
	        					<div class="col-lg-9 col-sm-9 col-12">
	        						<p><span class="border pl-2 pr-2 p-1 rounded mr-2">Item1</span><span class="border pl-2 pr-2 p-1 rounded mr-2">Item2</span><span class="border pl-2 pr-2 p-1 rounded mr-2">Item3</span></p>
	        					</div>
	        				</div>
	        			</div>

	        			<div class="col-lg-6 col-sm-6 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-3 col-sm-3 col-12">Default Item(s)</label>
	        					<div class="col-lg-9 col-sm-9 col-12">
	        						<p><span class="border pl-2 pr-2 p-1 rounded mr-2">Item1</span><span class="border pl-2 pr-2 p-1 rounded mr-2">Item2</span><span class="border pl-2 pr-2 p-1 rounded mr-2">Item3</span></p>
	        					</div>
	        				</div>
	        			</div>

	        			<div class="col-lg-6 col-sm-6 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-3 col-sm-3 col-12">Coming soon (not launched yet)?</label>
	        					<div class="col-lg-9 col-sm-9 col-12">
	        						<p><input type="checkbox" name="come" checked disabled></p>
	        					</div>
	        				</div>
	        			</div>

						<div class="col-lg-6 col-sm-6 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-3 col-sm-3 col-12">Status</label>
	        					<div class="col-lg-9 col-sm-9 col-12">
	        						<p class="text-success">Active</p>
	        					</div>
	        				</div>
	        			</div>

	        			<div class="col-lg-6 col-sm-6 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-3 col-sm-3 col-12">Created at</label>
	        					<div class="col-lg-9 col-sm-9 col-12">
	        						<p>Aug-19-2020</p>
	        					</div>
	        				</div>
	        			</div>

	        			<div class="col-lg-12 col-sm-12 col-12">
	        				<div class="form-group row">
	        					<label class="col-lg-12 col-sm-12 col-12">Image(s)</label>
	        					<div class="col-lg-12 col-sm-12 col-12">
	        						<div class="row">
	        							<div class="col-lg-2 col-sm-3 col-6">
	        								<img src="image/homehow.jpg" class="img-fluid w-100 d-block mt-2">
	        							</div>

	        							<div class="col-lg-2 col-sm-3 col-6">
	        								<img src="image/homehow.jpg" class="img-fluid w-100 d-block mt-2">
	        							</div>

	        							<div class="col-lg-2 col-sm-3 col-6">
	        								<img src="image/homehow.jpg" class="img-fluid w-100 d-block mt-2">
	        							</div>

	        							<div class="col-lg-2 col-sm-3 col-6">
	        								<img src="image/homehow.jpg" class="img-fluid w-100 d-block mt-2">
	        							</div>

	        							<div class="col-lg-2 col-sm-3 col-6">
	        								<img src="image/homehow.jpg" class="img-fluid w-100 d-block mt-2">
	        							</div>

	        							<div class="col-lg-2 col-sm-3 col-6">
	        								<img src="image/homehow.jpg" class="img-fluid w-100 d-block mt-2">
	        							</div>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
	      		</div>
	    	</div>
	  	</div>
	</div>

@endsection
@section('script')

	<script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
	<!-- end - This is for export functionality only -->
	<script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

	<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/Lobibox.js') }}"></script>
	<script>
		$(function () {
			$('#example23').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'csv', 'excel', 'pdf', 'print'
				]
			});
			$('.buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
		});

		function confirmDelete(id) {
			url = "{{ url('/admin/meals/delete/') }}/" + id;
			deleteConfirmMessage(id, url, 'remove');
		}

		$(document).ready(function () {
			$(document).on('click', '.change_status', function () {
				var id = $(this).attr('id');
				url = "{{ url('/admin/meals/change_status/') }}/" + id;
				var status_val = $(this).attr('data-id');
				changeStatusConfirmMessage(id, url, 'change_status');
			});
			$('#check_all').change(function () {
				$("input:checkbox[name=delete_target]").prop('checked', this.checked);
			})
		});

		showMealPlan = (key) => {
			setLoading(true, () => {
				performGet({
					url: '/admin/meals/show/' + key,
					success: (message, data) => {
						$('#plan_details').html(data);
						$('#exampleModal').modal('show');
					},
					complete: () => {
						setLoading(false);
					}
				});
			});
		};

		function confirmDeleteBulk() {
			const url = "{{ url('/admin/meals/delete') }}";
			const items = [];
			$("input:checkbox[name=delete_target]:checked").each(function () {
				const parsed = Number.parseInt($(this).val());
				if (parsed !== 0)
					items.push(parsed);
			});
			deleteConfirmMessageBulk(url, items);
		}

	</script>
@endsection
