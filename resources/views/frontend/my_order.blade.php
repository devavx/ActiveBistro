@extends('layouts.master')
@section('title') Active Bistro | My Order @endsection
@section('css') 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<style type="text/css">
.error{
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

		<!-- <div class="col-lg-4 col-sm-4 col-6">
			<div class="myordertop mt-3 myordertoplogoutbtn text-right">
				<button class="btn btn-info btn-md m-0">Log Out</button>
			</div>
		</div> -->
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
							<th class="p-2 font-weight-bold text-white">Order ID</th>
							<th class="p-2 font-weight-bold text-white">Description of Order</th>
							<th class="p-2 font-weight-bold text-white">Price</th>
							<th class="p-2 font-weight-bold text-white">Estimated time of delivery</th>
							<th class="p-2 font-weight-bold text-white">Address of delivery</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">5 working days</td>
							<td class="p-2">This is dummy address</td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">5 working days</td>
							<td class="p-2">This is dummy address</td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">5 working days</td>
							<td class="p-2">This is dummy address</td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">5 working days</td>
							<td class="p-2">This is dummy address</td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">5 working days</td>
							<td class="p-2">This is dummy address</td>
						</tr>
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
							<th class="p-2 font-weight-bold text-white">Order ID</th>
							<th class="p-2 font-weight-bold text-white">Description of Order</th>
							<th class="p-2 font-weight-bold text-white">Price</th>
							<th class="p-2 font-weight-bold text-white">Date of delivery</th>
							<th class="p-2 font-weight-bold text-white">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>

						<tr>
							<td class="p-2">988998</td>
							<td class="p-2">This is dummy description</td>
							<td class="p-2">$90</td>
							<td class="p-2">06-07-2020</td>
							<td class="p-2"><a href="#" class="text-color">Re-order</a></td>
						</tr>
					</tbody>
				</table>
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
	$(document).ready(function() { 
		$('#example').DataTable();
		$('#example1').DataTable(); 
	});
</script> 
@endsection