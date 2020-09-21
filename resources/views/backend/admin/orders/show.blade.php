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