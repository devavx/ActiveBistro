<div class="row mb-3">
	<label class="col-12 col-12 mb-1">Images</label>
	@if(isset($images)&&count($images)>0)
		@php $index=0; @endphp
		@for(;$index<count($images);$index++)
			<div class="col-xs-12 col-sm-2 col-md-2">
				<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{$images[$index]['file']}}" data-key="{{$images[$index]['id']}}" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
			</div>
		@endfor
		@for(;$index<6;$index++)
			<div class="col-xs-12 col-sm-2 col-md-2">
				<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
			</div>
		@endfor
	@else
		<div class="col-xs-12 col-sm-2 col-md-2">
			<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-2">
			<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2">
			<input name="images[]" type="file" id="input-file-now" class="dropify form-control file-gallery" data-allowed-file-extensions="png jpg jpeg" @if(isset($locked)&&$locked==true) disabled @endif data-max-file-size="2M"/>
		</div>
	@endif
	<div class="col-xs-12 col-sm-12 col-md-12">
		<small class="form-text">Upto 2 MegaBytes each</small>
	</div>
</div>
