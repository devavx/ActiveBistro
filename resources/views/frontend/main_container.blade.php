<div class="container mt-3">

	<div class="row">

		<div class="col-lg-4 col-sm-4 col-12">


			<h5 class="text-color font-weight-bold">Average Daily Macros</h5>

			<table class="table table-striped table-bordered w-100 shadow-sm animate__animated animate__fadeInDown">

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

			<div class="text-center mt-3">

				<a href="{{ route('cart.items.list') }}" class="text-color border p-2 pl-3 pr-3">View Menu</a>

			</div>

		</div>


		<div class="col-lg-4 col-sm-4 col-12">

			<h5 class="text-color font-weight-bold">Recommended Daily Macros</h5>

			<table class="table table-striped table-bordered w-100 shadow-sm">

				<tr>

					<th class="p-2">Calories</th>

					@if(auth()->user()->calories()==0)

						<td class="p-2">-</td>

					@else

						<td class="p-2">{{auth()->user()->calories()}} kcal</td>

					@endif

				</tr>


				<tr>

					<th class="p-2">Protein</th>

					@if(auth()->user()->proteins()==0)

						<td class="p-2">-</td>

					@else

						<td class="p-2">{{auth()->user()->proteins()}} g</td>

					@endif

				</tr>


				<tr>

					<th class="p-2">Fats</th>

					@if(auth()->user()->fats()==0)

						<td class="p-2">-</td>

					@else

						<td class="p-2">{{auth()->user()->fats()}} g</td>

					@endif

				</tr>


				<tr>

					<th class="p-2">Carbohydrates</th>

					@if(auth()->user()->carbohydrates()==0)

						<td class="p-2">-</td>

					@else

						<td class="p-2">{{auth()->user()->carbohydrates()}} g</td>

					@endif

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

				<p class="text-color m-0">

					<u style="text-decoration: underline!important;">Mon-Tue-Wed</u> meals are delivered on

					<u style="text-decoration: underline!important;">Sundays</u>.</p>

				<p class="text-color m-0">

					<u style="text-decoration: underline!important;">Thurs-Fri-Sat-Sun</u> meals are delivered on

					<u style="text-decoration: underline!important;">Wednesdays</u>.</p>

			</div>

		</div>


		<div class="col-lg-6 col-sm-12 col-12">

			<div class="row">

				<div class="col-lg-5 col-sm-6 col-12">

					<div class="checktext-btn">

						<h5 class="m-0 font-weight-bold">&pound;<span id="total_weekly_amout">{{$state->subTotal()}}</span>

							per week</h5>

						<p class="text-color m-0"><i class="fa fa-truck mr-2"></i>Free Delivery, Always</p>

					</div>

				</div>


				<div class="col-lg-7 col-sm-6 col-12">

					<div class="checktextbtn">

						<form action="{{route('cart.checkout.index')}}" method="post">

							@csrf
							<button type="submit" class="btn btn-info btn-lg" @if($state->itemCount()<1) disabled @endif>Securely
								checkout
							</button>
						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>