<div class="row">
	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Name</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$plan->name}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Type</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{ucfirst($plan->type)}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Item(s)</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>
					@foreach($plan->items as $item)
						<span class="border pl-2 pr-2 p-1 rounded mr-2 @if($item->default==false) border border-danger @endif">{{$item->name}}</span>
					@endforeach
				</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Launched</label>
			<div class="col-lg-9 col-sm-9 col-12">
				@if($plan->launched==1)
					<p class="text-success">Yes</p>
				@else
					<p class="text-danger">No</p>
				@endif
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Allergy(s)</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>
					@foreach($plan->allergies as $allergy)
						<span class="border pl-2 pr-2 p-1 rounded mr-2">{{$allergy->name}}</span>
					@endforeach
				</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Status</label>
			<div class="col-lg-9 col-sm-9 col-12">
				@if($plan->active==1)
					<p class="text-success">Active</p>
				@else
					<p class="text-danger">Inactive</p>
				@endif
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Created at</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{changeDateFormat($plan->created_at,'M-d-Y')}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-12 col-sm-12 col-12">
		<div class="form-group row">
			<label class="col-lg-12 col-sm-12 col-12">Image(s)</label>
			<div class="col-lg-12 col-sm-12 col-12">
				<div class="row">
					@foreach($plan->images as $image)
						<div class="col-lg-2 col-sm-3 col-6">
							<img src="{{$image->file}}" class="img-fluid w-100 d-block mt-2">
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>