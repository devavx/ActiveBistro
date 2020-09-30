@extends('layouts.master')
@section('title') Our Menu  @endsection
@section('csss')
	<style type="text/css">

	</style>
@endsection
@section('content')
	<div class="container mt-5">
		<div class="row">
			<div class="col-12">
				<div class="our-menu-top">
					<div class="menu-name">
						<h1 class="font-weight-bold text-color">MENU</h1>
					</div>
					<div class="menu-date border p-2">
						<p class="text-center mb-0 text-color">Week on <br> Sep <br> <span>10</span></p>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="container mt-3">

		<div class="row">
			<div class="col-lg-7 col-sm-6 col-12">
				<div class="our-menu-toggle">
					<ul class="nav nav-pills" role="tablist">

						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#meals" role="tab">Meals</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-12">
				<form action="{{route('ourmenu')}}" id="filter_form">
					<div class="form-group mb-0">
						<select class="form-control" name="type" id="type" onchange="handleFilterChanged();">
							<option value="none" selected>Dietary Filter</option>
							@foreach($types as $type)
								<option value="{{ $type->id }}" @if($chosen==$type->id) selected @endif>{{ $type->name }}</option>
							@endforeach
						</select>
					</div>
				</form>
			</div>

			<div class="col-lg-2 col-sm-3 col-12">
				<a href="{{route('order-now.index')}}" class="btn btn-info m-0 btn-md btn-block">Order Now
					<i class="fa fa-chevron-right ml-2"></i>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Nav tabs -->
				<div class="ourentrees-breakfast mb-5">
					<div class="tab-content pt-3">

						<div class="tab-pane active" id="entrees" role="tabpanel">
							<div class="row">
								@foreach($meals as $meal)
									<div class="col-lg-3 col-sm-4 col-12">
										<div class="menucol rounded mt-3 shadow pb-3" data-toggle="modal" data-target="#meal_details_{{$meal->id}}">
											<div class="menuimgcol">
												<img src="{{$meal->images->first()->file}}" class="img-fluid rounded w-100 d-block">
												<div class="menu-col-text rounded">
													<a href="#">View + Detail</a>
												</div>
											</div>

											<div class="menucoltext text-center p-2">
												<h5 class="mb-1 text-color">{{$meal->name}}</h5>
												<p class="m-0" style="visibility: hidden;"></p>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	@foreach($meals as $meal)
		<div class="modal fade right shadow" id="meal_details_{{$meal->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-full-height modal-right" role="document">
				<div class="modal-content">
					<div class="modal-header bg-color ">
						<h5 class="modal-title w-100 text-white">{{$meal->name}}</h5>
						<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="text-white">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6 col-sm-12 col-12">
								<div class="ourmenu-modal text-center">
									<img src="{{$meal->images->first()->file}}" class="img-fluid w-100 rounded d-block">

									<h5 class="text-color mb-1">{{$meal->name}}</h5>
									<p style="visibility: hidden;"></p>

									<ul class="nav nav-pills justify-content-center" role="tablist">
										<li class="nav-item active">
											<a class="nav-link" data-toggle="tab" href="#tab-ingredients" role="tab">Ingredients</a>
										</li>
									</ul>


									<div class="tab-content pt-3">
										<div class="tab-pane active" id="tab-ingredients" role="tabpanel">
											<p>{{implode(", ",$meal->ingredients()->unique('id')->pluck('name')->toArray())}}</p>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12 col-12">
								<div class="our-menu-right-modal">
									<img src="{{asset("uploads/image/logo.png")}}" class="img-fluid w-100 d-block ">
								</div>

								<div class="row">
									<div class="col-4">
										<div class="modalrightsubp text-center mt-3">
											<h6 class="font-weight-bold mb-1 text-color">{{$meal->items->sum('protein')}}</h6>
											<p>Protein</p>
										</div>
									</div>

									<div class="col-4">
										<div class="modalrightsubp text-center mt-3">
											<h6 class="font-weight-bold mb-1 text-color">{{$meal->items->sum('fat')}}</h6>
											<p>Fat</p>
										</div>
									</div>

									<div class="col-4">
										<div class="modalrightsubp text-center mt-3">
											<h6 class="font-weight-bold mb-1 text-color">{{$meal->items->sum('carbs')}}</h6>
											<p>Carbs</p>
										</div>
									</div>
								</div>

								<h5 class="text-color mb-3 font-weight-bold">Nutritional Facts</h5>

								<p class="mb-1 pb-2 border-bottom d-none">Serving Size(g)
									<span class="font-weight-bold float-right text-color">10</span></p>

								<p class="mb-1 pb-2 border-bottom d-none">Servings Per Container
									<span class="font-weight-bold float-right text-color">2</span></p>

								<h6 class="font-weight-bold text-color d-none">Amount Per Serving</h6>

								<p class="mb-1 pb-2 border-bottom">Calories (Kcal)
									<span class="font-weight-bold float-right text-color">{{$meal->items->sum('calories')}}</span>
								</p>

								<p class="mb-1 pb-2 border-bottom">Total Fat (Grams)<span class="font-weight-bold float-right text-color">{{$meal->items->sum('fat')}}</span>
								</p>

								<p class="mb-1 pb-2 border-bottom d-none">Saturated Fat g
									<span class="font-weight-bold float-right text-color">3.3%</span></p>

								<p class="mb-1 pb-2 border-bottom d-none">Trans Fat g<span class="font-weight-bold float-right text-color">85%</span>
								</p>

								<p class="mb-1 pb-2 border-bottom d-none">Cholesterol mg
									<span class="font-weight-bold float-right text-color">8%</span></p>

								<p class="mb-1 pb-2 border-bottom d-none">Sodium mg
									<span class="font-weight-bold float-right text-color">8%</span></p>

								<p class="mb-1 pb-2 border-bottom">Total Carbohydrates (Grams)
									<span class="font-weight-bold float-right text-color">{{$meal->items->sum('carbs')}}</span>
								</p>
								<p class="mb-1 pb-2 border-bottom">Total Protein (Grams)
									<span class="font-weight-bold float-right text-color">{{$meal->items->sum('protein')}}</span>
								</p>
								<p class="mb-1 pb-2 border-bottom">Total Fat (Grams)
									<span class="font-weight-bold float-right text-color">{{$meal->items->sum('fat')}}</span>
								</p>
								<p class="mb-1 pb-2 border-bottom d-none">Dietary Fiber g<span class="font-weight-bold float-right text-color">8%</span>
								</p>
								<p class="mb-1 pb-2 border-bottom d-none">Sugar g<span class="font-weight-bold float-right text-color">8965</span>
								</p>
								<p class="mb-1 pb-2 border-bottom d-none">Protein g<span class="font-weight-bold float-right text-color">{{$meal->items->where('default',true)->sum('protein')}}</span>
								</p>
								<p class="mb-1 pb-2 border-bottom d-none">Vitamin-D mcg<span class="font-weight-bold float-right text-color">7%</span>
								</p>
								<p class="mb-1 pb-2 border-bottom d-none">Calcium mg<span class="font-weight-bold float-right text-color">9%</span>
								</p>
								<p class="mb-1 pb-2 border-bottom d-none">Iron mg<span class="font-weight-bold float-right text-color">11%</span>
								</p>
								<p class="mb-1 pb-2 border-bottom d-none">Potassium mcg<span class="font-weight-bold float-right text-color">8%</span>
								</p>

								<p>* Present Daily values are based on 2,000 calories diet. Your daily values may be higher or lower depending on your calories need.</p>
							</div>
						</div>
					</div>
					<div class="modal-footer p-0 justify-content-left">
						<a href="{{route('cart.index')}}" class="btn btn-info btn-md">Order Now<i class="fa fa-chevron-right ml-2"></i></a>
						<button type="button" class="btn btn-dark btn-md" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	@endforeach

@endsection
@section('script')
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		handleFilterChanged = (value) => {
			console.log('Changed');
			$('#filter_form').submit();
		};
	</script>
@endsection