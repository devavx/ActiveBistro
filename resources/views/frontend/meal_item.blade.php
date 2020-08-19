<div>
	<div class="card">
		<div class="card-header p-2 mb-0 bg-white border-0">
			<h5 class="text-color mb-0">{{\App\Core\Enums\Common\DaysOfWeek::getKey($key)}}</h5>
		</div>
		<div class="card-body p-2 meal__item__count">
			@foreach($value as $plan)
				<h6 class="mt-2">{{ $plan->meal->name }}</h6>
				<div class="mealcol" id="mealcol__{{ $plan->meal->id }}">
					<div class="meal-left meal__price">
						@foreach($plan->items as $item)
							@if($item->pivot->default==true)
								<p class="mb-1 item__price" data-price="{{ $item->selling_price }}" data-id="{{ $item->itemId }}">
									<a href="javascript:void(0)">
										<u id="monday__item__{{ $key }}">{{ $item->name }}</u>
									</a>
									<span class="text-color font-weight-bold ml-2">£ <span id="price__monday__item__{{ $key }}"> {{ $item->selling_price }} </span>
								            	                                </span>
								</p>
							@endif
						@endforeach
					</div>
					<div class="meal-mealright text-right">
						<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
						<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

						<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
						<hr class="mt-1 mb-1">
						<div class="text-right">
							<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $plan->meal->id }})"><i class="fa fa-pencil"></i></a>
							<span class="countnum font-weight-bold ml-2 mr-2">/</span>
							<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
						</div>
					</div>
				</div>
				<div class="meal-form" id="meal-form__{{$plan->meal->id}}">
					<div class="rowform">
						<div class="mealform-left">
							<form>
								<select class="form-control">
									@foreach($plan->items as $item)
										@if($item->pivot->slab==1)
											<div class="form-group">
												<option value="{{$item->id}}" @if($item->pivot->default==true) selected @endif>{{$item->name}}</option>
											</div>
										@endif
									@endforeach
								</select>
								<select class="form-control">
									@foreach($plan->items as $item)
										@if($item->pivot->slab==2)
											<div class="form-group">
												<option value="{{$item->id}}" @if($item->pivot->default==true) selected @endif>{{$item->name}}</option>
											</div>
										@endif
									@endforeach
								</select>
								<select class="form-control">
									@foreach($plan->items as $item)
										@if($item->pivot->slab==3)
											<div class="form-group">
												<option value="{{$item->id}}" @if($item->pivot->default==true) selected @endif>{{$item->name}}</option>
											</div>
										@endif
									@endforeach
								</select>
							</form>
						</div>
						<div class="mealform-right text-right">
							<a href="javascript:void(0);" class="text-color save-data" onclick="saveData({{ $plan->meal->id }})"><i class="fa fa-check-square-o"></i></a>
							<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							<a href="javascript:void(0);" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
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