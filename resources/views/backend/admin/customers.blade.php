@extends('backend.master')

@section('title') Admin | Customers @endsection

@section('style')
	<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/loader_spin.css') }}">

@endsection
@section('content')
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Customer List</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
							<li class="breadcrumb-item active">Customer</li>
						</ol>
						<!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Customer List</h4>
							<div class="text-right">
								<button type="button" onclick="confirmDeleteBulk();" class="btn btn-primary mr-4">
									<i class="fa fa-trash mr-2"></i>Delete
								</button>
							</div>
							<!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
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
										<th>Email</th>
										<th>Profile Image</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>

									@if(!empty($listData))
										@foreach($listData as $rows)
											<tr>
												<td>
													<label><input type="checkbox" name="delete_target" value="{{$rows->id}}"><span class="sr-only"> Select Row </span></label>
												</td>
												<td>{{$loop->index+1}}</td>

												<td>{{ $rows->name ?? '-' }}</td>
												<td>{{ $rows->email ?? '-' }}</td>
												<td>
													<img src="{{ $rows->profile_image }}" class="img-thumbnail" width="100">
												</td>
												<td>{{ changeDateFormat($rows->created_at,'M-d-Y') }}</td>
												<td style="text-align: center; ">
												@if(!empty($rows->role->name) && $rows->role->name=='admin')
													{{ 'Admin' }}
												@else
													<!-- <a class="like" href="{{ url('/admin/customer'.'/'.$rows->id) }}" title="Edit"><i class="fas fa-edit text-info"></i></a> /    -->
														<a class="like" href="{{ url('/admin/customers'.'/'.$rows->id) }}" title="View details"><i class="fas fa-eye text-success"></i></a>
														/
														<a class="remove" href="javascript:void(0)" onclick="confirmDelete({{ $rows->id }})" title="Remove"><i class="fas fa-trash text-danger"></i></a>
													@endif
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4" class="text-danger">No Record Found !</td>
										</tr>
									@endif
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



@endsection
@section('script')

	<script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
	<!-- start - This is for export functionality only -->
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
	<!-- end - This is for export functionality only -->
	<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/Lobibox.js') }}"></script>
	<script>
		initialized = () => {
			$('#check_all').change(function () {
				$("input:checkbox[name=delete_target]").prop('checked', this.checked);
			})
		}

		$(function () {
			$('#example23').DataTable({
				dom: 'Bfrtip',
				buttons: [
					{
						extend: 'csvHtml5',
						exportOptions: {
							columns: [1, 2, 3, 4, 6]
						}
					},
					{
						extend: 'excelHtml5',
						exportOptions: {
							columns: [1, 2, 3, 4, 6]
						}
					},
					{
						extend: 'pdfHtml5',
						exportOptions: {
							columns: [1, 2, 3, 4, 6]
						}
					},
				]
			});
			$('.buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
		});

		function confirmDelete(id) {
			url = "{{ url('/admin/customer/delete/') }}/" + id;
			deleteConfirmMessage(id, url, 'remove');
		}

		function confirmDeleteBulk() {
			const url = "{{ url('/admin/customer/delete') }}";
			const items = [];
			$("input:checkbox[name=delete_target]:checked").each(function () {
				const parsed = Number.parseInt($(this).val());
				if (parsed !== 0)
					items.push(parsed);
			});
			if (items.length > 0)
				deleteConfirmMessageBulk(url, items);
		}

	</script>
@endsection
