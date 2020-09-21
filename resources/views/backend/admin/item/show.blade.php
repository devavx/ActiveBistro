<div class="row">
	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Name</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->name}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Short Description</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->short_description}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Description</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->long_description}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Category</label>
			<div class="col-lg-9 col-sm-9 col-12">
				@if($item->category()->exists())
					<p>{{$item->category->name}}</p>
				@else
					<p>-</p>
				@endif
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Protein</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->protein}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Calories</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->calories}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Carbohydrates</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->carbs}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Fats</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->fat}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Type</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->type->name}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Actual Price</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->actual_price}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Selling Price</label>
			<div class="col-lg-9 col-sm-9 col-12">
				<p>{{$item->selling_price}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-12">
		<div class="form-group row">
			<label class="col-lg-3 col-sm-3 col-12">Status</label>
			<div class="col-lg-9 col-sm-9 col-12">
				@if($item->active==1)
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
				<p>{{changeDateFormat($item->created_at,'M-d-Y')}}</p>
			</div>
		</div>
	</div>

	<div class="col-lg-12 col-sm-12 col-12">
		<div class="form-group row">
			<label class="col-lg-12 col-sm-12 col-12">Thumbnail</label>
			<div class="col-lg-12 col-sm-12 col-12">
				<div class="row">
					<div class="col-lg-2 col-sm-3 col-6">
						<img src="{{$item->thumbnail}}" class="img-fluid w-100 d-block mt-2">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>