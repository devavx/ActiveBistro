<div>
	<div class="card">
		<div class="card-header p-2 mb-0 bg-white border-0">
			<h5 class="text-color mb-0">{{\App\Core\Enums\Common\DaysOfWeek::getKey($key)}}</h5>
		</div>
		<div class="card-body p-2 meal__item__count">
			@foreach($value as $plan)
				<h6 class="mb-1">{{ $plan->meal->name }}</h6>
				<div class="mealcol" id="mealcol__{{ $plan->meal->id }}">
					<div class="meal-left meal__price">
						@foreach($plan->items as $itemInner)
							<p class="mb-1 item__price" data-price="{{ $itemInner->selling_price }}" data-id="{{ $itemInner->itemId }}">
								<a href="javascript:void(0)">
									<u id="monday__item__{{ $key }}">{{ $itemInner->name }}</u>
								</a>
								<span class="text-color font-weight-bold ml-2">£ <span id="price__monday__item__{{ $key }}"> {{ $itemInner->selling_price }} </span>
								            	                                </span>
							</p>
						@endforeach
					</div>
					<div class="meal-mealright text-right">
						<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
						<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

						<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
						<hr class="mt-1 mb-1">
						<div class="text-right">
							<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $itemInner->id }})"><i class="fa fa-pencil"></i></a>
							<span class="countnum font-weight-bold ml-2 mr-2">/</span>
							<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
						</div>
					</div>
				</div>

				<div class="meal-form" id="meal-form__{{ $itemInner->id }}">
					<div class="rowform">
						<div class="mealform-left">
							<form>
								<div class="form-group">
									<select class="form-control" onchange="changeItem({{ $itemInner->id }},'monday__item__0', this)" id="{{ $itemInner->id }}">
										@if(!empty($itemInner->items))
											@foreach($itemInner->items as $key => $itemVal)
												<option value="{{ $itemVal->itemId }}" data-item="{{ $itemVal->name }}" data-price="{{ $itemVal->selling_price }}">{{ $itemVal->name }}</option>

											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group">
									<select class="form-control" onchange="changeItem({{ $itemInner->id }},'monday__item__1', this)" id="{{ $itemInner->id }}">
										@if(!empty($itemInner->items))
											@foreach($itemInner->items as $key => $itemVal)
												<option value="{{ $itemVal->itemId }}" data-item="{{ $itemVal->name }}" data-price="{{ $itemVal->selling_price }}">{{ $itemVal->name }}</option>

											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group">
									<select class="form-control" onchange="changeItem({{ $itemInner->id }},'monday__item__2', this)" id="{{ $itemInner->id }}">
										@if(!empty($itemInner->items))
											@foreach($itemInner->items as $key => $itemVal)
												<option value="{{ $itemVal->itemId }}" data-item="{{ $itemVal->name }}" data-price="{{ $itemVal->selling_price }}">{{ $itemVal->name }}</option>

											@endforeach
										@endif
									</select>
								</div>
							</form>
						</div>
						<div class="mealform-right text-right">
							<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $itemInner->id }})"><i class="fa fa-check-square-o"></i></a>
							<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
						</div>
					</div>
				</div>
			@endforeach
			<div class="text-center mt-3 card-btn">
				<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
			</div>
		</div>
	</div>
</div>