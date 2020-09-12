<div class="container mt-3">
	<div class="row">
		<div class="col-lg-4 col-sm-4 col-12">

			<h5 class="text-color font-weight-bold">Total</h5>
			<table class="table table-striped table-bordered w-100">
				<tr>
					<th class="p-2">Calories</th>
					<td class="p-2">{{$state->calories()}} kcal</td>
				</tr>

				<tr>
					<th class="p-2">Protein</th>
					<td class="p-2">{{$state->proteins()}} g</td>
				</tr>

				<tr>
					<th class="p-2">Fats</th>
					<td class="p-2">{{$state->fats()}} g</td>
				</tr>

				<tr>
					<th class="p-2">Carbohydrates</th>
					<td class="p-2">{{$state->carbohydrates()}} g</td>
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
					<td class="p-2 w-50" colspan="2">{{auth()->user()->calories()}} kcal</td>
				</tr>

				<tr class="text-center">
					<td class="p-2">{{auth()->user()->proteins()}} g</td>
					<td class="p-2">{{auth()->user()->fats()}} g</td>
					<td class="p-2">{{auth()->user()->carbohydrates()}} g</td>
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
							@foreach(\App\Core\Enums\Common\DaysOfWeek::sequence() as $key)
								@include('frontend.meal_item',['plans'=>$state->card($key),'key'=>$key])
							@endforeach
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
						<h5 class="m-0 font-weight-bold">£ <span id="total_weekly_amout">{{$state->total()}}</span>
							per week</h5>
						<p class="text-color m-0"><i class="fa fa-truck mr-2"></i>Free Delivery, Always</p>
					</div>
				</div>

				<div class="col-lg-7 col-sm-6 col-12">
					<div class="checktextbtn">
						<form action="{{route('cart.checkout.index')}}" method="post">
							@csrf
							<button type="submit" class="btn btn-info btn-lg">Securely
								checkout
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>