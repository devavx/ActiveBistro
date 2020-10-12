@if(isset($address)&&$address!=null)
	<div id="wednesday_address">
		<div class="form-group">
			<h6 class="mb-1 font-weight-bold text-color">Wednesday Deliveries</h6>
		</div>
		<div class="form-group">
			<label>Address Line 1</label>
			<input type="text" class="form-control" name="address[wednesday][address_first_line]" data-parsley-group="address" minlength="2" maxlength="100" required value="{{$address->address_first_line}}">
		</div>

		<div class="form-group">
			<label>Address Line 2</label>
			<input type="text" class="form-control" name="address[wednesday][address_second_line]" data-parsley-group="address" minlength="2" maxlength="100" required value="{{$address->address_second_line}}">
		</div>
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-12">
				<div class="form-group">
					<label>Town / City</label>
					<input type="text" class="form-control" name="address[wednesday][city]" minlength="1" data-parsley-group="address" maxlength="50" required value="{{$address->city}}">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-12">
				<div class="form-group">
					<label>Postcode</label>
					<select name="address[wednesday][postcode]" id="" class="form-control" data-parsley-group="address">
						<option value="">Choose...</option>
						@foreach($postalCodes as $code)
							<option value="{{$code->name}}" @if($code->name==$address->postcode) selected @endif>{{$code->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Delivery Notes</label>
			<textarea class="form-control" rows="3" name="address[wednesday][delivery_notes]" data-parsley-group="address">{{$address->delivery_notes}}</textarea>
		</div>
	</div>
@else
	<div id="wednesday_address">
		<div class="form-group">
			<h6 class="mb-1 font-weight-bold text-color">Wednesday Deliveries</h6>
		</div>
		<div class="form-group">
			<label>Address Line 1</label>
			<input type="text" class="form-control" name="address[wednesday][address_first_line]" data-parsley-group="address" minlength="2" maxlength="100">
		</div>

		<div class="form-group">
			<label>Address Line 2</label>
			<input type="text" class="form-control" name="address[wednesday][address_second_line]" data-parsley-group="address" minlength="2" maxlength="100">
		</div>
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-12">
				<div class="form-group">
					<label>Town / City</label>
					<input type="text" class="form-control" name="address[wednesday][city]" minlength="1" data-parsley-group="address" maxlength="50">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-12">
				<div class="form-group">
					<label>Postcode</label>
					<select name="address[wednesday][postcode]" id="" class="form-control" data-parsley-group="address">
						<option value="">Choose...</option>
						@foreach($postalCodes as $code)
							<option value="{{$code->name}}" selected>{{$code->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Delivery Notes</label>
			<textarea class="form-control" rows="3" name="address[wednesday][delivery_notes]" data-parsley-group="address"></textarea>
		</div>
	</div>
@endif