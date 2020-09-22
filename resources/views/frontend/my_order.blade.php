@extends('layouts.master')
@section('title') Active Bistro | My Order @endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
	<style type="text/css">
        .error {
            color: red;
        }
	</style>
@endsection
@section('content')



	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-12">
				<div class="myordertop mt-3">
					<h5 class="font-weight-bold text-color">Order Information</h5>
				</div>
			</div>
			<div class="col-lg-4 col-sm-4 col-6">
				<div class="myordertop mt-3 myordertop-btn">
					<button class="btn btn-info btn-md m-0">Order Meals</button>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<h5 class="font-weight-bold text-color text-center">Active Orders</h5>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="table-responsive myorder-table">
					<table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
						<thead>
						<tr class="bg-color">
							<th class="p-2 font-weight-bold text-white">Order Id</th>
							<th class="p-2 font-weight-bold text-white">Address</th>
							<th class="p-2 font-weight-bold text-white">Total</th>
							<th class="p-2 font-weight-bold text-white">Payment Slab</th>
							<th class="p-2 font-weight-bold text-white">No. of Meals</th>
							<th class="p-2 font-weight-bold text-white">Detail</th>
						</tr>
						</thead>
						<tbody>
						@foreach($pendingOrders as $order)
							<tr>
								<td class="p-2">#{{$order->id}}</td>
								<td class="p-2">{{$order->address->stringify()}}</td>
								<td class="p-2">&pound;{{$order->total}}</td>
								<td class="p-2">{{ucfirst($order->payment_slab)}}</td>
								<td class="p-2">{{$order->quantity}}</td>
								<td class="p-2">
									<button title="View details" class="btn btn-link text-color" onclick="showDetails('{{$order->id}}');">
										<i class="fa fa-eye"></i></button>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-12">
				<h5 class="font-weight-bold text-color text-center">Completed Orders</h5>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="table-responsive myorder-table">
					<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
						<thead>
						<tr class="bg-color">
							<th class="p-2 font-weight-bold text-white">Order Id</th>
							<th class="p-2 font-weight-bold text-white">Address</th>
							<th class="p-2 font-weight-bold text-white">Total</th>
							<th class="p-2 font-weight-bold text-white">Payment Slab</th>
							<th class="p-2 font-weight-bold text-white">No. of Meals</th>
						</tr>
						</thead>
						<tbody>
						@foreach($otherOrders as $order)
							<tr>
								<td class="p-2">#{{$order->id}}</td>
								<td class="p-2">{{$order->address->stringify()}}</td>
								<td class="p-2">&pound;{{$order->total}}</td>
								<td class="p-2">{{ucfirst($order->payment_slab)}}</td>
								<td class="p-2">{{$order->quantity}}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="detailmodal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-xl" role="document">
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
					<button type="button" class="btn btn-info btn-md" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js
"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#example').DataTable();
			$('#example1').DataTable();
		});

		showDetails = key => {
			setLoading(true, () => {
				performGet({
					url: `/my_order/show/${key}`,
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