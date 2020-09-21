@extends('backend.master')

@section('title') Admin | Orders @endsection

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
					<h4 class="text-themecolor">Orders List</h4>

				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item active">Orders</li>
						</ol>
					<!-- <a href="{{ url('/admin/items/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                    class="fa fa-plus-circle"></i> Create New</a> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Orders List</h4>
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
								<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
									<tr>
										<th scope="col" class="border">
											<label><input type="checkbox" data-tablesaw-checkall id="check_all"><span class="sr-only"> Check All</span></label>
										</th>
										<th>Sr. No.</th>
										<th>OrderId</th>
										<th>Customer Name</th>
										<th>Status</th>
										<th>Address</th>
										<th>Total</th>
										<th>Payment Slab</th>
										<th>No Of Meals</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										@foreach($orders as $order)
											<td>
												<label><input type="checkbox" name="delete_target"><span class="sr-only"> Select Row </span></label>
											</td>
											<td>{{$loop->index+1}}</td>
											<td> #{{$order->id}}</td>
											<td><a href data-toggle="modal" data-target="#detailmodal">{{$order->user->name}}</a></td>
											<td> {{ucfirst($order->status)}}</td>
											<td> {{$order->address->stringify()}}</td>
											<td> {{$order->total}}</td>
											<td> {{ucfirst($order->payment_slab)}}</td>
											<td> {{$order->quantity}}</td>
											<td> {{$order->created_at}}</td>
											<td style="text-align: center; ">
{{--												<a class="like" href="{{route('admin.orders.show',$order->id)}}" title="View"><i class="fa fa-search text-info"></i></a>&nbsp;/--}}
												<a class="remove" href="javascript:void(0)" onclick="confirmDelete({{ $order->id }})" title="Remove"><i class="fas fa-trash text-danger"></i></a>
											</td>
										@endforeach
									</tr>
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
					<h4 class="modal-title">Order Detail</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-12">
							<div class="form-group row">
								<label class="col-lg-3 col-sm-3 col-12">Order ID</label>
								<div class="col-lg-9 col-sm-9 col-12">
									<p>#123</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<div class="form-group row">
								<label class="col-lg-3 col-sm-3 col-12">Customer Name</label>
								<div class="col-lg-9 col-sm-9 col-12">
									<p>David</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<div class="form-group row">
								<label class="col-lg-3 col-sm-3 col-12">Status</label>
								<div class="col-lg-9 col-sm-9 col-12">
									<p class="text-success">Open</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<div class="form-group row">
								<label class="col-lg-3 col-sm-3 col-12">Address</label>
								<div class="col-lg-9 col-sm-9 col-12">
									<p>A-113 Sector 12 Noida Uttar Pradesh 110012</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<div class="form-group row">
								<label class="col-lg-3 col-sm-3 col-12">Total</label>
								<div class="col-lg-9 col-sm-9 col-12">
									<p>1000</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<div class="form-group row">
								<label class="col-lg-3 col-sm-3 col-12">No. of Meal</label>
								<div class="col-lg-9 col-sm-9 col-12">
									<p>12</p>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<div class="form-group row">
								<label class="col-lg-3 col-sm-3 col-12">Created</label>
								<div class="col-lg-9 col-sm-9 col-12">
									<p>14/12/2020</p>
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

		initialized = () => {
			$('#check_all').change(function () {
				$("input:checkbox[name=delete_target]").prop('checked', this.checked);
			})
		}

		function confirmDelete(id) {
			url = "{{ url('/admin/orders/delete/') }}/" + id;
			deleteConfirmMessage(id, url, 'remove');
		}

		function confirmDeleteBulk() {
			const url = "{{ url('/admin/orders/delete') }}";
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
