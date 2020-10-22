@if(isset($address)&&$address!=null)

	<div id="sunday_address">

		<div class="form-group">

			<label>Address Line 1</label>

			<input type="text" class="form-control" name="address[sunday][address_first_line]" data-parsley-group='["sunday_address","address"]' required minlength="2" maxlength="100" value="{{$address->address_first_line}}" onkeyup="makeSundayAddress();" id="sunday_al1">

		</div>


		<div class="form-group">

			<label>Address Line 2</label>

			<input type="text" class="form-control" name="address[sunday][address_second_line]" data-parsley-group='["sunday_address","address"]' minlength="2" maxlength="100" value="{{$address->address_second_line}}" onkeyup="makeSundayAddress();" id="sunday_al2">

		</div>


		<div class="row">

			<div class="col-lg-4 col-sm-4 col-12">

				<div class="form-group">

					<label>Town / City</label>

					<input type="text" class="form-control" name="address[sunday][city]" minlength="1" data-parsley-group='["sunday_address","address"]' maxlength="50" required value="{{$address->city}}" onkeyup="makeSundayAddress();" id="sunday_town">

				</div>

			</div>


			<div class="col-lg-8 col-sm-8 col-12">

				<div class="form-group row">

					<label class="col-12">Postcode (select and enter ending)</label>

					<div class="col-lg-6 col-sm-6 col-12">
						<select name="address[sunday][postcode]" id="" class="form-control" data-parsley-group='["sunday_address","address"]' required onchange="makeSundayAddress();" id="sunday_postcode">

							@foreach($postalCodes as $code)

								<option value="{{$code->name}}" @if($code->name==$address->postcode) selected @endif>{{$code->name}}</option>

							@endforeach

						</select>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">

						<input type="text" class="form-control" name="address[sunday][area_code]" minlength="5" data-parsley-group='["sunday_address","address"]' maxlength="5" required value="{{$address->area_code}}" onkeyup="makeSundayAddress();" id="sunday_areacode">


					</div>

				</div>

			</div>


		</div>


		<div class="form-group">

			<label>Phone</label>

			<input type="text" name="address[sunday][phone]" class="form-control" minlength="11" maxlength="11" data-parsley-group='["sunday_address","address"]' required value="{{$address->phone}}" onkeyup="makeSundayAddress(this.value,'phone');" id="sunday_phone">

			<small>Your phone number is only used for delivery purposes.</small>

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

			<input type="text" class="form-control" name="address[sunday][address_first_line]" data-parsley-group='["sunday_address","address"]' required minlength="2" maxlength="100" onkeyup="makeSundayAddress(this.value,'al1');" id="sunday_al1">

		</div>


		<div class="form-group">

			<label>Address Line 2</label>

			<input type="text" class="form-control" name="address[sunday][address_second_line]" data-parsley-group='["sunday_address","address"]' minlength="2" maxlength="100" onkeyup="makeSundayAddress(this.value,'al2');" id="sunday_al2">

		</div>


		<div class="form-group row">

			<div class="col-lg-4 col-sm-4 col-12">

				<div class="form-group">

					<label>Town / City</label>

					<input type="text" class="form-control" name="address[sunday][city]" id="tcSunday" minlength="1" data-parsley-group='["sunday_address","address"]' maxlength="50" required onkeyup="makeSundayAddress(this.value,'town');" id="sunday_town">

				</div>

			</div>


			<div class="col-lg-8 col-sm-8 col-12">


				<div class="form-group row">
					<label class="col-12">Postcode (select and enter ending)</label>

					<div class="col-lg-6 col-sm-6 col-12">

						<select name="address[sunday][postcode]" id="" class="form-control" data-parsley-group='["sunday_address","address"]' required onkeyup="makeSundayAddress(this.value,'postcode');" id="sunday_postcode">

							@foreach($postalCodes as $code)

								<option value="{{$code->name}}">{{$code->name}}</option>

							@endforeach

						</select>

					</div>

					<div class="col-lg-6 col-sm-6 col-12">

						<input type="text" class="form-control" name="address[sunday][area_code]" minlength="4" data-parsley-group='["sunday_address","address"]' maxlength="5" required value="" onkeyup="makeSundayAddress(this.value,'areacode');" id="sunday_areacode">

					</div>

				</div>

			</div>

		</div>


		<div class="form-group">

			<label>Phone</label>

			<input type="text" name="address[sunday][phone]" class="form-control" minlength="11" maxlength="11" data-parsley-group='["sunday_address","address"]' required value="{{auth()->user()->phone}}" onkeyup="makeSundayAddress(this.value,'phone');" id="sunday_phone">

			<small>Your phone number is only used for delivery purposes.</small>

		</div>


		<div class="form-group">

			<label>Delivery Notes</label>

			<textarea class="form-control" rows="3" name="address[sunday][delivery_notes]" data-parsley-group='["sunday_address","address"]'></textarea>

		</div>

	</div>

@endif