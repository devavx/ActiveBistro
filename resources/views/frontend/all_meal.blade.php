@extends('layouts.master')
@section('title') Active Bistro | All Meals @endsection
@section('css') 
 <link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #000 !important;
    }
</style>
@endsection
@section('content') 
	<link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<form id="msform" class="p-3 mt-5">
			        <ul id="progressbar">
					    <li class="active" id="account"><strong>Welcome</strong></li>
						<li class="active" id="personal"><strong>Tailor Plan</strong></li>
					    <li class="active" id="payment-status"><strong>Choose Meals</strong></li>
					    <li id="payment"><strong>Checkout</strong></li>
					</ul>
			    </form>
			</div>
		</div>
	</div> 

	<div class="bg-color p-2 mt-3">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-8 col-sm-8 col-12">
							<h5 class="text-white pt-3 font-weight-bold">Your tailored meal plan</h5>
						</div>

						<div class="col-lg-4 col-sm-4 col-12">
							<div class="form-group mb-0">
								<select class="form-control">
									<option>Dietary Filters</option>
									<option>Keto</option>
									<option>Vegan</option>
									<option>Vegetarian</option>
								</select>
								<label class="text-white mb-0">Gluten Free</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-3">
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-12">

				<h5 class="text-color font-weight-bold">Total</h5>
				<table class="table table-striped table-bordered w-100">
					<tr>
						<th class="p-2">Calories</th>
						<td class="p-2">3214 kcal</td>
					</tr>

					<tr>
						<th class="p-2">Protein</th>
						<td class="p-2">72 g</td>
					</tr>

					<tr>
						<th class="p-2">Fats</th>
						<td class="p-2">40 g</td>
					</tr>

					<tr>
						<th class="p-2">Carbohydrates</th>
						<td class="p-2">234 g</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="text-center">
					<a href="{{ url('/items') }}" class="text-color border p-2 pl-3 pr-3"><u>View Menu</u></a>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<h5 class="text-color font-weight-bold">Recommended</h5>
				<table class="table table-striped table-bordered">
			        <tr class="text-center">
			        	<th class="p-2 w-50">Calories</th>
			        	<td class="p-2 w-50" colspan="2">3400 kcal</td>
			        </tr>

			        <tr class="text-center">
			        	<td class="p-2">180 g</td>
			        	<td class="p-2">90 g</td>
			        	<td class="p-2">364 g</td>
			        </tr>

			        <tr class="text-center">
			        	<th class="p-2">Protein</th>
			        	<th class="p-2">Fat</th>
			        	<th class="p-2">Carbohydrate</th>
			        </tr>
			    </table>
			</div>
		</div>
	</div>

	<div class="container-fluid mb-3 mt-5">
		<div class="row">
			<div class="col-12">
				<div class="ecommerce-testimonials mt-3">
					<div class="container-fluid">
						<div class="row">
							<div class="owl-carousel owl-carousel1 owl-theme item_meal_section">
						      	<div>
							        <div class="card">
							        	<div class="card-header p-2 mb-0 bg-white border-0">
							        		<h5 class="text-color mb-0">Monday</h5>
							        	</div>
							          <div class="card-body p-2 meal__item__count">
							          	@if(!empty($listData))
							          	@php
							          		$i=1
							          	@endphp
							          		@foreach($listData as $key => $rows)
							          			@if($rows->no_of_days == 'Mon')
							            <h6 class="mb-1">{{ $rows->name }}</h6>

							            <div class="mealcol" id="mealcol__{{ $rows->id }}">
							            	<div class="meal-left meal__price">
							            	@if(!empty($rows->items))
							            	@foreach($rows->items as $key => $itemRow)  
								            <p class="mb-1 item__price" data-price="{{ $itemRow->selling_price }}" data-id="{{ $itemRow->itemId }}">
								            	<a href="javascript:void(0)">
								            		<u id="monday__item__{{ $key }}">{{ $itemRow->name }}</u>
								            	</a> 
								            	<span class="text-color font-weight-bold ml-2">£ <span id="price__monday__item__{{ $key }}"> {{ $itemRow->selling_price }} </span>
								            	</span>
								            </p> 
								            <?php 
								             	if($key==2){
										            break;
										    } ?>
							            	@endforeach
							            	@endif
							            	</div>
							            	<div class="meal-mealright text-right">
							            		<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
							            		<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

							            		<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
												<hr class="mt-1 mb-1">  
							            		<div class="text-right">
							            			<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $rows->id }})"><i class="fa fa-pencil"></i></a> <span class="countnum font-weight-bold ml-2 mr-2">/</span> 
							            			<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            		</div>
							            	</div>
							            </div>

							            <div class="meal-form" id="meal-form__{{ $rows->id }}">
							            	<div class="rowform">
							            		<div class="mealform-left">
							            		<form>
							            			<div class="form-group">
							            				<select class="form-control" onchange="changeItem({{ $rows->id }},'monday__item__0', this)" id="{{ $rows->id }}">
							            				@if(!empty($rows->items))
							            				@foreach($rows->items as $key => $itemVal)
							            					<option value="{{ $itemVal->itemId }}" data-item="{{ $itemVal->name }}" data-price="{{ $itemVal->selling_price }}">{{ $itemVal->name }}</option>

										            	@endforeach
										            	@endif 
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control" onchange="changeItem({{ $rows->id }},'monday__item__1', this)" id="{{ $rows->id }}">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->itemId }}" data-item="{{ $itemVal->name }}" data-price="{{ $itemVal->selling_price }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control" onchange="changeItem({{ $rows->id }},'monday__item__2', this)" id="{{ $rows->id }}">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->itemId }}" data-item="{{ $itemVal->name }}" data-price="{{ $itemVal->selling_price }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>
							            		</form>
							            	</div>
							            	<div class="mealform-right text-right">
							            		<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $rows->id }})"><i class="fa fa-check-square-o"></i></a>
							            		<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							            		<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            	</div>
							            	</div>
							            </div>	
							            		@php
									          		$i +=1
									          	@endphp
							            		@endif
							            	@endforeach
							            @endif 
							            <div class="text-center mt-3 card-btn">
							            	<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
							            </div>
							          </div>
							        </div>
						      	</div>

						      	<div>
							        <div class="card">
							        	<div class="card-header p-2 mb-0 bg-white border-0">
							        		<h5 class="text-color mb-0">Tuesday</h5>
							        	</div>
							          <div class="card-body p-2 meal__item__count" >
							            @if(!empty($listData))
							          	@php
							          		$i=1
							          	@endphp
							          		@foreach($listData as $key => $rows)
							          			@if($rows->no_of_days == 'Tue')
							            <h6 class="mb-1">{{ $rows->name }}</h6>
							            <div class="mealcol" id="mealcol__{{ $rows->id }}">
							            	<div class="meal-left meal__price">
							            	@if(!empty($rows->items))
							            	@foreach($rows->items as $key => $itemRow)  
								            <p class="mb-1 item__price" data-price="{{ $itemRow->selling_price }}" data-id="{{ $itemRow->itemId }}"><a href="javascript:void(0)"><u>{{ $itemRow->name }}</u></a> <span class="text-color font-weight-bold ml-2">£ {{ $itemRow->selling_price }}</span></p>  
								            <?php 
								             	if($key==2){
										             break;
										    } ?>
							            	@endforeach
							            	@endif
							            	</div>
							            	<div class="meal-mealright text-right">
							            		<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
							            		<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

							            		<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
												<hr class="mt-1 mb-1">  
							            		<div class="text-right">
							            			<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $rows->id }})"><i class="fa fa-pencil"></i></a> <span class="countnum font-weight-bold ml-2 mr-2">/</span> 
							            			<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            		</div>
							            	</div>
							            </div>

							            <div class="meal-form" id="meal-form__{{ $rows->id }}">
							            	<div class="rowform">
							            		<div class="mealform-left">
							            		<form>
							            			<div class="form-group">
							            				<select class="form-control">
							            				@if(!empty($rows->items))
							            				@foreach($rows->items as $key => $itemVal)
							            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

										            	@endforeach
										            	@endif 
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>
							            		</form>
							            	</div>
							            	<div class="mealform-right text-right">
							            		<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $rows->id }})"><i class="fa fa-check-square-o"></i></a>
							            		<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							            		<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            	</div>
							            	</div>
							            </div>

							           			@php
									          		$i +=1
									          	@endphp
							            		@endif
							            	@endforeach
							            @endif  
							            <div class="text-center mt-3 card-btn">
							            	<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
							            </div> 
							          </div>
							        </div>
						      	</div>

						      	<div>
							        <div class="card">
							        	<div class="card-header p-2 mb-0 bg-white border-0">
							        		<h5 class="text-color mb-0">Wednesday</h5>
							        	</div>
							          <div class="card-body p-2 meal__item__count">@if(!empty($listData))
							          	@php
							          		$i=1
							          	@endphp
							          		@foreach($listData as $key => $rows)
							          			@if($rows->no_of_days == 'Wed')
							            <h6 class="mb-1">{{ $rows->name }}</h6>

							           <div class="mealcol" id="mealcol__{{ $rows->id }}">
							            	<div class="meal-left meal__price">
							            	@if(!empty($rows->items))
							            	@foreach($rows->items as $key => $itemRow)  
								            <p class="mb-1 item__price" data-price="{{ $itemRow->selling_price }}" data-id="{{ $itemRow->itemId }}"><a href="javascript:void(0)"><u>{{ $itemRow->name }}</u></a> <span class="text-color font-weight-bold ml-2">£ {{ $itemRow->selling_price }}</span></p>  
								            <?php 
								             	if($key==2){
										             break;
										    } ?>
							            	@endforeach
							            	@endif
							            	</div>
							            	<div class="meal-mealright text-right">
							            		<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
							            		<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

							            		<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
												<hr class="mt-1 mb-1">  
							            		<div class="text-right">
							            			<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $rows->id }})"><i class="fa fa-pencil"></i></a> <span class="countnum font-weight-bold ml-2 mr-2">/</span> 
							            			<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            		</div>
							            	</div>
							            </div>

							            <div class="meal-form" id="meal-form__{{ $rows->id }}">
							            	<div class="rowform">
							            		<div class="mealform-left">
							            		<form>
							            			<div class="form-group">
							            				<select class="form-control">
							            				@if(!empty($rows->items))
							            				@foreach($rows->items as $key => $itemVal)
							            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

										            	@endforeach
										            	@endif 
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>
							            		</form>
							            	</div>
							            	<div class="mealform-right text-right">
							            		<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $rows->id }})"><i class="fa fa-check-square-o"></i></a>
							            		<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							            		<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            	</div>
							            	</div>
							            </div>
												@php
									          		$i +=1
									          	@endphp
							            		@endif
							            	@endforeach
							            @endif  

							            <div class="text-center mt-3 card-btn">
							            	<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
							            </div> 
							          </div>
							        </div>
						      	</div>

						      	<div>
							        <div class="card">
							        	<div class="card-header p-2 mb-0 bg-white border-0">
							        		<h5 class="text-color mb-0">Thursday</h5>
							        	</div>
							          <div class="card-body p-2 meal__item__count">@if(!empty($listData))
							          	@php
							          		$i=1
							          	@endphp
							          		@foreach($listData as $key => $rows)
							          			@if($rows->no_of_days == 'Thu')
							            <h6 class="mb-1">{{ $rows->name }}</h6>

							          <div class="mealcol" id="mealcol__{{ $rows->id }}">
							            	<div class="meal-left meal__price">
							            	@if(!empty($rows->items))
							            	@foreach($rows->items as $key => $itemRow)  
								            <p class="mb-1 item__price" data-price="{{ $itemRow->selling_price }}" data-id="{{ $itemRow->itemId }}"><a href="javascript:void(0)"><u>{{ $itemRow->name }}</u></a> <span class="text-color font-weight-bold ml-2">£ {{ $itemRow->selling_price }}</span></p> 
								            <?php 
								             	if($key==2){
										             break;
										    } ?> 
							            	@endforeach
							            	@endif
							            	</div>
							            	<div class="meal-mealright text-right">
							            		<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
							            		<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

							            		<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
												<hr class="mt-1 mb-1">  
							            		<div class="text-right">
							            			<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $rows->id }})"><i class="fa fa-pencil"></i></a> <span class="countnum font-weight-bold ml-2 mr-2">/</span> 
							            			<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            		</div>
							            	</div>
							            </div>

							            <div class="meal-form" id="meal-form__{{ $rows->id }}">
							            	<div class="rowform">
							            		<div class="mealform-left">
							            		<form>
							            			<div class="form-group">
							            				<select class="form-control">
							            				@if(!empty($rows->items))
							            				@foreach($rows->items as $key => $itemVal)
							            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

										            	@endforeach
										            	@endif 
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>
							            		</form>
							            	</div>
							            	<div class="mealform-right text-right">
							            		<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $rows->id }})"><i class="fa fa-check-square-o"></i></a>
							            		<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							            		<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            	</div>
							            	</div>
							            </div>
								            		@php
										          		$i +=1
										          	@endphp
							            		@endif
							            	@endforeach
							            @endif

							            <div class="text-center mt-3 card-btn">
							            	<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
							            </div>      
							          </div>
							        </div>
						      	</div>

						      	<div>
							        <div class="card">
							        	<div class="card-header p-2 mb-0 bg-white border-0">
							        		<h5 class="text-color mb-0">Friday</h5>
							        	</div>
							          <div class="card-body p-2 meal__item__count">@if(!empty($listData))
							          	@php
							          		$i=1
							          	@endphp
							          		@foreach($listData as $key => $rows)
							          			@if($rows->no_of_days == 'Fri')
							            <h6 class="mb-1">{{ $rows->name }}</h6>

							            <div class="mealcol" id="mealcol__{{ $rows->id }}">
							            	<div class="meal-left meal__price">
							            	@if(!empty($rows->items))
							            	@foreach($rows->items as $key => $itemRow)  
								            <p class="mb-1 item__price" data-price="{{ $itemRow->selling_price }}" data-id="{{ $itemRow->itemId }}"><a href="javascript:void(0)"><u>{{ $itemRow->name }}</u></a> <span class="text-color font-weight-bold ml-2">£ {{ $itemRow->selling_price }}</span></p>  
								            <?php 
								             	if($key==2){
										             break;
										    } ?>
							            	@endforeach
							            	@endif
							            	</div>
							            	<div class="meal-mealright text-right">
							            		<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
							            		<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

							            		<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
												<hr class="mt-1 mb-1">  
							            		<div class="text-right">
							            			<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $rows->id }})"><i class="fa fa-pencil"></i></a> <span class="countnum font-weight-bold ml-2 mr-2">/</span> 
							            			<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            		</div>
							            	</div>
							            </div>

							            <div class="meal-form" id="meal-form__{{ $rows->id }}">
							            	<div class="rowform">
							            		<div class="mealform-left">
							            		<form>
							            			<div class="form-group">
							            				<select class="form-control">
							            				@if(!empty($rows->items))
							            				@foreach($rows->items as $key => $itemVal)
							            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

										            	@endforeach
										            	@endif 
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>
							            		</form>
							            	</div>
							            	<div class="mealform-right text-right">
							            		<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $rows->id }})"><i class="fa fa-check-square-o"></i></a>
							            		<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							            		<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            	</div>
							            	</div>
							            </div>
							            		@php
									          		$i +=1
									          	@endphp
							            		@endif
							            	@endforeach
							            @endif 
							            <div class="text-center mt-3 card-btn">
							            	<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
							            </div> 
							          </div>
							        </div>
						      	</div>

						      	<div>
							        <div class="card">
							        	<div class="card-header p-2 mb-0 bg-white border-0">
							        		<h5 class="text-color mb-0">Saturday</h5>
							        	</div>
							          <div class="card-body p-2 meal__item__count">
							          	@if(!empty($listData))
							          	@php
							          		$i=1
							          	@endphp
							          		@foreach($listData as $key => $rows)
							          			@if($rows->no_of_days == 'Sat')
							            <h6 class="mb-1">{{ $rows->name }}</h6>

							            <div class="mealcol" id="mealcol__{{ $rows->id }}">
							            	<div class="meal-left meal__price">
							            	@if(!empty($rows->items))
							            	@foreach($rows->items as $key => $itemRow)  
								            <p class="mb-1 item__price" data-price="{{ $itemRow->selling_price }}" data-id="{{ $itemRow->itemId }}"><a href="javascript:void(0)"><u>{{ $itemRow->name }}</u></a> <span class="text-color font-weight-bold ml-2">£ {{ $itemRow->selling_price }}</span></p>  
								            <?php 
								             	if($key==2){
										             break;
										    } ?>
							            	@endforeach
							            	@endif
							            	</div>
							            	<div class="meal-mealright text-right">
							            		<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
							            		<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

							            		<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
												<hr class="mt-1 mb-1">  
							            		<div class="text-right">
							            			<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $rows->id }})"><i class="fa fa-pencil"></i></a> <span class="countnum font-weight-bold ml-2 mr-2">/</span> 
							            			<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            		</div>
							            	</div>
							            </div>

							            <div class="meal-form" id="meal-form__{{ $rows->id }}">
							            	<div class="rowform">
							            		<div class="mealform-left">
							            		<form>
							            			<div class="form-group">
							            				<select class="form-control">
							            				@if(!empty($rows->items))
							            				@foreach($rows->items as $key => $itemVal)
							            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

										            	@endforeach
										            	@endif 
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>
							            		</form>
							            	</div>
							            	<div class="mealform-right text-right">
							            		<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $rows->id }})"><i class="fa fa-check-square-o"></i></a>
							            		<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							            		<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            	</div>
							            	</div>
							            </div>
							            		@php
									          		$i +=1
									          	@endphp
							            		@endif
							            	@endforeach
							            @endif  
							            <div class="text-center mt-3 card-btn">
							            	<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
							            </div> 
							          </div>
							        </div>
						      	</div>

						      	<div>
							        <div class="card">
							        	<div class="card-header p-2 mb-0 bg-white border-0">
							        		<h5 class="text-color mb-0">Sunday</h5>
							        	</div>
							          <div class="card-body p-2 meal__item__count">@if(!empty($listData))
							          	@php
							          		$i=1
							          	@endphp
							          		@foreach($listData as $key => $rows)
							          			@if($rows->no_of_days == 'Sun')
							            <h6 class="mb-1">{{ $rows->name }}</h6>

							            <div class="mealcol" id="mealcol__{{ $rows->id }}">
							            	<div class="meal-left meal__price">
							            	@if(!empty($rows->items))
							            	@foreach($rows->items as $key => $itemRow)  
								            <p class="mb-1 item__price" data-price="{{ $itemRow->selling_price }}" data-id="{{ $itemRow->itemId }}"><a href="javascript:void(0)"><u>{{ $itemRow->name }}</u></a> <span class="text-color font-weight-bold ml-2">£ {{ $itemRow->selling_price }}</span></p>  
								            <?php 
								             	if($key==2){
										             break;
										    } ?>
							            	@endforeach
							            	@endif
							            	</div>
							            	<div class="meal-mealright text-right">
							            		<a href="javascript:void(0)"><span><i class="fa fa-minus text-color"></i></span></a>
							            		<span class="countnum ml-2 mr-2 font-weight-bold">1</span>

							            		<a href="javascript:void(0)" class="float-right"><span><i class="fa fa-plus text-color"></i></span></a>
												<hr class="mt-1 mb-1">  
							            		<div class="text-right">
							            			<a href="javascript:void(0)" class="text-color editdata" onclick="editdata({{ $rows->id }})"><i class="fa fa-pencil"></i></a> <span class="countnum font-weight-bold ml-2 mr-2">/</span> 
							            			<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            		</div>
							            	</div>
							            </div>

							            <div class="meal-form" id="meal-form__{{ $rows->id }}">
							            	<div class="rowform">
							            		<div class="mealform-left">
							            		<form>
							            			<div class="form-group">
							            				<select class="form-control">
							            				@if(!empty($rows->items))
							            				@foreach($rows->items as $key => $itemVal)
							            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

										            	@endforeach
										            	@endif 
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>

							            			<div class="form-group">
							            				<select class="form-control">
							            					@if(!empty($rows->items))
								            				@foreach($rows->items as $key => $itemVal)
								            					<option value="{{ $itemVal->name }}">{{ $itemVal->name }}</option>

											            	@endforeach
											            	@endif
							            				</select>
							            			</div>
							            		</form>
							            	</div>
							            	<div class="mealform-right text-right">
							            		<a href="javascript:void(0)" class="text-color save-data" onclick="saveData({{ $rows->id }})"><i class="fa fa-check-square-o"></i></a>
							            		<span class="font-weight-bold countnum ml-2 mr-2">/</span>
							            		<a href="javascript:void(0)" class="text-danger font-weight-bold"><i class="fa fa-trash"></i></a>
							            	</div>
							            	</div>
							            </div>
							            		@php
									          		$i +=1
									          	@endphp
							            		@endif
							            	@endforeach
							            @endif 
							            <div class="text-center mt-3 card-btn">
							            	<a href="{{ url('/items') }}" class="btn btn-info btn-md">Add Item</a>
							            </div>
							          </div>
							        </div>
						      	</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-3 mb-5">
		<div class="row">
			<div class="col-lg-6 col-sm-12 col-12">
				<div class="checktext">
					<p class="text-color m-0">This is the flexible service. You can edit, pause or cancel at any
						time!</p>
				</div>
			</div>

			<div class="col-lg-6 col-sm-12 col-12">
				<div class="row">
					<div class="col-lg-5 col-sm-6 col-12">
						<div class="checktext-btn">
							<h5 class="m-0 font-weight-bold">£ <span id="total_weekly_amout">245.35</span> per week</h5>
							<p class="text-color m-0"><i class="fa fa-truck mr-2"></i>Free Delivery, Always</p>
						</div>
					</div>

					<div class="col-lg-7 col-sm-6 col-12">
						<div class="checktextbtn">
							<a href="checkoutprocess.html" class="btn btn-info btn-lg">Securely checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
@section('script')

<script type="text/javascript" src="{{ asset('assets/js/owl.carousel.js') }}"></script>  
<script type="text/javascript"> 
    	function editdata(id){
    		$("#mealcol__"+id).hide(); 
            $("#meal-form__"+id).show();
    	} 
    	function saveData(id){
    		$("#meal-form__"+id).hide();
    		$("#mealcol__"+id).show();  
    	} 
   	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	}) 
</script>
	<!-- // Owl-carousel1 Script -->
	<script>
   	(function () {
  "use strict";

  var carousels = function () {
    $(".owl-carousel1").owlCarousel({
      // loop: true,
      center: true,
      margin: 0,
      
      responsiveClass: true,
      nav: false,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        680: {
          items: 2,
          nav: false,
          loop: false
        },
        1000: {
          items: 3,
          nav: true
        }
      }
    });
  };

  (function ($) {
    carousels();
  })(jQuery);
})();
   </script>

   <script type="text/javascript">  
   			countTotalAmount()
	   		function countTotalAmount() {
	   			var totalAmount = 0;
				// alert($('p.item__price').length);
				$('.item_meal_section .meal__item__count p').each(function(){ 
				    // $(this).parent().attr('data-lity','');
				  totalAmount +=  parseFloat($(this).attr('data-price')); 
				  // alert($(this).attr('data-price'));
				});
				// alert(totalAmount);

				$('#total_weekly_amout').html(totalAmount);
	   		} 

	   		function changeItem(mealId,itemElement, element){
	   			console.log(element.value);
	   			var selectedItemName = $(element).find("option:selected").data("item") 
	   			var selectedItemPrice = $(element).find("option:selected").data("price") 
	   			console.log(selectedItemName);
	   			var selectedItemId = $('option:selected').val(); 

  				// alert(selectedItemId);
  				// alert(selectedItem);
  				// alert(itemElement);
	   			$('#'+itemElement).html(selectedItemName);
	   			$('#price__'+itemElement).html(selectedItemPrice);
	   		} 
   </script>

@endsection