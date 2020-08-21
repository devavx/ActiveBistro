<div>
	<div class="card">
		<div class="card-header p-2 mb-0 bg-white border-0">
			<h5 class="text-color mb-0">{{\App\Core\Enums\Common\DaysOfWeek::getKey($key)}}</h5>
		</div>
		<div class="card-body p-2 meal__item__count">
			@foreach($plans as $plan)
				<h6 class="mt-2">{{ $plan->name }}</h6>
				<div class="mealcol" id="mealcol__{{ $plan->id }}">
					<div class="meal-left meal__price">
						@foreach($plan->items as $item)
							@if($item->pivot->default==true)
								<p class="mb-1 item__price" data-price="{{ $item->selling_price }}" data-id="{{ $item->id }}">
									<a href="javascript:void(0)">
										<u id="target_{{$plan->id}}_{{$item->pivot->slab}}_name">{{ $item->name }}</u>
									</a>
									<span class="text-color font-weight-bold ml-2">£ <span id="target_{{$plan->id}}_{{$item->pivot->slab}}_price"> {{ $item->selling_price }} </span></span>
								</p>
							@endif
						@endforeach
					</div>
					<div class="meal-mealright text-right">
						<a href="#!" onclick="decreaseQuantity('{{$key}}',{{$plan->id}});"><span><i class="fa fa-minus text-color"></i></span></a>

						<span class="countnum ml-2 mr-2 font-weight-bold" data-quantity="{{$plan->quantity}}" id="target_quantity_{{$plan->id}}">{{$plan->quantity}}</span>

						<a href="#!" onclick="increaseQuantity('{{$key}}',{{$plan->id}});" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
						<hr class="mt-1 mb-1">
						<div class="text-right">
							<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $plan->id }})"><i class="fa fa-pencil"></i></a>
							<span class="countnum font-weight-bold ml-2 mr-2">/</span>
							<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
						</div>
					</div>
				</div>
				<div class="meal-form" id="meal-form__{{$plan->id}}">
					<div class="rowform">
						<div class="mealform-left">
							<form>
								<select class="form-control" onchange="handleItemChanged('{{$plan->id}}',1,this.value,this.selectedOptions[0].getAttribute('data-price'),this.selectedOptions[0].getAttribute('data-name'),'{{$key}}');">
									@foreach($plan->items as $item)
										@if($item->pivot->slab==1)
											<div class="form-group">
												<option value="{{$item->id}}" data-price="{{$item->selling_price}}" data-name="{{$item->name}}" @if($item->pivot->default==true) selected @endif>{{$item->name}}</option>
											</div>
										@endif
									@endforeach
								</select>
								<select class="form-control" onchange="handleItemChanged('{{$plan->id}}',2,this.value,this.selectedOptions[0].getAttribute('data-price'),this.selectedOptions[0].getAttribute('data-name'),'{{$key}}');">
									@foreach($plan->items as $item)
										@if($item->pivot->slab==2)
											<div class="form-group">
												<option value="{{$item->id}}" data-price="{{$item->selling_price}}" data-name="{{$item->name}}" @if($item->pivot->default==true) selected @endif>{{$item->name}}</option>
											</div>
										@endif
									@endforeach
								</select>
								<select class="form-control" onchange="handleItemChanged('{{$plan->id}}',3,this.value,this.selectedOptions[0].getAttribute('data-price'),this.selectedOptions[0].getAttribute('data-name'),'{{$key}}');">
									@foreach($plan->items as $item)
										@if($item->pivot->slab==3)
											<div class="form-group">
												<option value="{{$item->id}}" data-price="{{$item->selling_price}}" data-name="{{$item->name}}" @if($item->pivot->default==true) selected @endif>{{$item->name}}</option>
											</div>
										@endif
									@endforeach
								</select>
							</form>
						</div>
						<div class="mealform-right text-right">
							<a href="javascript:void(0);" class="text-color save-data" onclick="saveData({{ $plan->id }})"><i class="fa fa-check-square-o"></i></a>
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