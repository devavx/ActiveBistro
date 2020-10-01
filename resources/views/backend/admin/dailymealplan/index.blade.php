@extends('backend.master')

@section('title') Admin | Daily Meals @endsection

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
					<h4 class="text-themecolor">Daily Meals</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item active">Daily Meals</li>
						</ol>
						<a href="{{ route('admin.daily-meals.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
									class="fa fa-plus-circle"></i> Create New</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Daily Meals List</h4>
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
											<label><input type="checkbox" data-tablesaw-checkall id="check_all"><span class="sr-only"> Check All</span></label>
										</th>

										<th>#</th>

										<th>Name</th>
										<th>Day</th>
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

											<td>
												<button class="btn btn-link" onclick="showDetails('{{$plan->id}}');"> {{\App\Core\Primitives\Str::placeholder($plan->name)}}</button>
											</td>
											<td> {{\App\Core\Enums\Common\DaysOfWeek::getKey($plan->day)}}</td>
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
												<a class="like" href="javascript:void(0);" onclick="showDetails('{{$plan->id}}');" title="View"><i class="fa fa-eye text-primary"></i></a>
												/
												<a class="like" href="{{ route('admin.daily-meals.edit',$plan->id) }}" title="Edit"><i class="fas fa-edit text-info"></i></a>
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
	<div id="cover-spin" style="display: none;"></div>

	<div class="modal" id="detailmodal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Meal Details</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="content-body">

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
		function confirmDelete(id) {
			url = "{{ url('/admin/daily-meals/delete/') }}/" + id;
			deleteConfirmMessage(id, url, 'remove');
		}

		initialized = () => {
			$('#example23').DataTable({
				dom: 'Bfrtip',
				buttons: [
					{
						extend: 'csvHtml5',
						exportOptions: {
							columns: [1, 2, 3, 4, 6, 7]
						}
					},
					{
						extend: 'excelHtml5',
						exportOptions: {
							columns: [1, 2, 3, 4, 6, 7]
						}
					},
					{
						extend: 'pdfHtml5',
						exportOptions: {
							columns: [1, 2, 3, 4, 6, 7]
						}
					},
				]
			});
			$('.buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
			$(document).on('click', '.change_status', function () {
				var id = $(this).attr('id');
				url = "{{ url('/admin/daily-meals/change_status/') }}/" + id;
				var status_val = $(this).attr('data-id');
				changeStatusConfirmMessage(id, url, 'change_status');
			});
			$('#check_all').change(function () {
				$("input:checkbox[name=delete_target]").prop('checked', this.checked);
			})
		}

		showMealPlan = (key) => {
			setLoading(true, () => {
				performGet({
					url: '/admin/daily-meals/show/' + key,
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
			const url = "{{ url('/admin/daily-meals/delete') }}";
			const items = [];
			$("input:checkbox[name=delete_target]:checked").each(function () {
				const parsed = Number.parseInt($(this).val());
				if (parsed !== 0)
					items.push(parsed);
			});
			if (items.length > 0)
				deleteConfirmMessageBulk(url, items);
		}

		showDetails = key => {
			setLoading(true, () => {
				performGet({
					url: `/admin/daily-meals/show/${key}`,
					success: (message, data) => {
						$('#content-body').html(data);
						$('#detailmodal').modal('show');
					},
					failed: message => {

					},
					complete: () => {
						setLoading(false);
					}
				});
			});
		};

	</script>
@endsection
