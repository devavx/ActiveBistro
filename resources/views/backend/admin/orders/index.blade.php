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
								<a class="btn btn-secondary mr-4" href="{{route('admin.orders.export')}}">
									Export
								</a>
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
										<th>
											<label><input type="checkbox" data-tablesaw-checkall id="check_all"><span class="sr-only"> Check All</span></label>
										</th>
										<th>#</th>
										<th>OrderId</th>
										<th>Customer</th>
										<th>No Of Meals</th>
										<th>Total</th>
										<th>Status</th>
										<th>Placed</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									@foreach($orders as $order)
										<tr>
											<td>
												<label><input type="checkbox" name="delete_target"><span class="sr-only"> Select Row </span></label>
											</td>
											<td>{{$loop->index+1}}</td>
											<td>
												<button class="btn btn-link" onclick="showDetails('{{$order->id}}');"> #{{$order->invoice_id}}</button>
											</td>
											<td>{{$order->user->name}}</td>
											<td>{{$order->quantity}}</td>
											<td>&pound;{{sprintf("%.2f",$order->total)}}</td>
											<td>
												<select name="" id="" class="form-control" onchange="updateOrderStatus(this.value,'{{$order->id}}');">
													@foreach(\App\Core\Enums\Common\OrderStatus::toArray() as $key=>$value)
														<option value="{{$value}}" @if($value==$order->status) selected @endif>{{$key}}</option>
													@endforeach
												</select>
											</td>
											<td>{{date('d M g:i A',strtotime($order->created_at))}}</td>
											<td style="text-align: center; ">
												<a class="remove" href="javascript:void(0)" onclick="confirmDelete({{ $order->id }})" title="Remove"><i class="fas fa-trash text-danger"></i></a>
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
		<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Order Details</h4>
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
	<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/Lobibox.js') }}"></script>
	<script>
		initialized = () => {
			$('#check_all').change(function () {
				$("input:checkbox[name=delete_target]").prop('checked', this.checked);
			})
			$('#example23').DataTable({
				dom: 'Bfrtip',
				buttons: []
			});
			$('.buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
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
			if (items.length > 0)
				deleteConfirmMessageBulk(url, items);
		}

		showDetails = key => {
			setLoading(true, () => {
				performGet({
					url: `/admin/orders/show/${key}`,
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

		function updateOrderStatus(status, key) {
			// setLoading(true, () => {
			performPut({
				url: `/admin/orders/${key}/${status}`,
				success: (message, data) => {
					Lobibox.notify('success', {
						position: 'top right',
						msg: message
					});
				},
				failed: message => {
					Lobibox.notify('error', {
						position: 'top right',
						msg: message
					});
				},
				before: () => {
					setLoading(true);
				},
				complete: () => {
					setLoading(false);
				}
			})
			// })
		}

	</script>
@endsection
