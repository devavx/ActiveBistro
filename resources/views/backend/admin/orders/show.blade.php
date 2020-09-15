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
							<h4 class="card-title">Order Details</h4>
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
							<div class="card">
								<div class="card-body">
									<form class="form-horizontal" role="form">
										<div class="form-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Invoice:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->invoice_id}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Payment Slab:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{ucfirst($order->payment_slab)}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Sub Total:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->sub_total}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Total:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->total}} </p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Status:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{ucfirst($order->status)}} </p>
														</div>
													</div>
												</div>
											</div>
											<h4 class="box-title">Customer Details</h4>
											<hr class="m-t-0 m-b-40">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">First Name:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->user->first_name}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Last Name:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->user->last_name}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
											<!--/row-->
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Gender:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{ucfirst($order->user->gender)}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Date of Birth:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->user->dob}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
											<!--/row-->
											<h4 class="box-title">Address Details</h4>
											<hr class="m-t-0 m-b-40">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Address Line 1:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->address->address_first_line}} </p>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Address Line 2:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->address->address_second_line}} </p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">City:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->address->city}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">State:</label>
														<div class="col-md-9">
															<p class="form-control-static"> Gujarat </p>
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group row">
														<label class="control-label text-right col-md-3">Post Code:</label>
														<div class="col-md-9">
															<p class="form-control-static"> {{$order->address->postcode}} </p>
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
											<h4 class="box-title">Items</h4>
											<hr class="m-t-0 m-b-40">
											<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Meal Name</th>
													<th>Items</th>
													<th>Quantity</th>
													<th>Total</th>
												</tr>
												</thead>
												<tbody>
												@foreach($order->items as $item)
													<tr>
														<td>{{$loop->index+1}}</td>
														<td> {{$item->meal->name}}</td>
														<td>
															@foreach($item->items as $subItem)
																<span>{{$subItem->name}}</span><br>
															@endforeach
														</td>
														<td> {{$item->quantity}}</td>
														<td> {{$item->total}}</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</form>
								</div>
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
