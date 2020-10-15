@if(isset($address)&&$address!=null)
	<div id="sunday_address">
		<div class="form-group">
			<label>Address Line 1</label>
			<input type="text" class="form-control" name="address[sunday][address_first_line]" data-parsley-group='["sunday_address","address"]' required minlength="2" maxlength="100" value="{{$address->address_first_line}}">
		</div>

		<div class="form-group">
			<label>Address Line 2</label>
			<input type="text" class="form-control" name="address[sunday][address_second_line]" data-parsley-group='["sunday_address","address"]' minlength="2" maxlength="100" value="{{$address->address_second_line}}">
		</div>

		<div class="row">
			<div class="col-lg-6 col-sm-6 col-12">
				<div class="form-group">
					<label>Town / City</label>
					<input type="text" class="form-control" name="address[sunday][city]" minlength="1" data-parsley-group='["sunday_address","address"]' maxlength="50" required value="{{$address->city}}">
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-12">
				<div class="form-group">
					<label>Postcode</label>
					<select name="address[sunday][postcode]" id="" class="form-control" data-parsley-group='["sunday_address","address"]' required>
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
			<textarea class="form-control" rows="3" name="address[sunday][delivery_notes]" data-parsley-group='["sunday_address","address"]'>{{$address->delivery_notes}}</textarea>
		</div>
	</div>
@else
	<div id="sunday_address">
		<div class="form-group">
			<label>Address Line 1</label>
			<input type="text" class="form-control" name="address[sunday][address_first_line]" data-parsley-group='["sunday_address","address"]' required minlength="2" maxlength="100">
		</div>

		<div class="form-group">
			<label>Address Line 2</label>
			<input type="text" class="form-control" name="address[sunday][address_second_line]" data-parsley-group='["sunday_address","address"]' minlength="2" maxlength="100">
		</div>

		<div class="row">
			<div class="col-lg-4 col-sm-4 col-12">
				<div class="form-group">
					<label>Town / City</label>
					<input type="text" class="form-control" name="address[sunday][city]" minlength="1" data-parsley-group='["sunday_address","address"]' maxlength="50" required>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="form-group">
					<label>Post code</label>
					<select name="address[sunday][postcode]" id="" class="form-control" data-parsley-group='["sunday_address","address"]' required>
						<option value="">Choose...</option>
						@foreach($postalCodes as $code)
							<option value="{{$code->name}}">{{$code->name}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="form-group">
					<label>Dummy Text</label>
					<input type="text" class="form-control">
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-sm-12 col-12">
			<div class="form-group">
				<label>Dummy Text</label>
				<input type="text" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label>Delivery Notes</label>
			<textarea class="form-control" rows="3" name="address[sunday][delivery_notes]" data-parsley-group='["sunday_address","address"]'></textarea>
		</div>
	</div>
@endif