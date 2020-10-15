@extends('layouts.master')
@section('title') Active Bistro | All Item @endsection
@section('css')
	<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
	<style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000 !important;
        }

        .menuimgcol .carousel-control-prev, .menuimgcol .carousel-control-next {
            display: none;
            background-color: unset;
        }

        .menuimgcol:hover .carousel-control-prev, .menuimgcol:hover .carousel-control-next {
            display: block;
        }

        .menuimgcol .carousel .carousel-item img {
            height: 307px;
        }
	</style>
@endsection
@section('content')
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

	<div class="container mt-3">
		<div class="row">
			<div class="col-lg-9 col-sm-9 col-12">
				<div class="our-menu-toggle">
					<ul class="nav nav-pills" role="tablist">
						@foreach($categories as $category)
							<li class="nav-item">
								<a class="nav-link @if($loop->index==0) active @endif" data-toggle="tab" href="#category_{{$category->id}}" role="tab">{{$category->name}}</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-12">
				<form id="filter_form">
					<div class="form-group mb-0">
						<select class="form-control" name="type" id="type" onchange="handleFilterChanged(this.value);">
							<option value="none" selected>Dietary Filter</option>
							@foreach($types as $type)
								<option value="{{ $type->id }}" @if($chosen==$type->id) selected @endif>{{ $type->name }}</option>
							@endforeach
						</select>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-12">
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
					<a href="{{ route('cart.index') }}" class="text-color border p-2 pl-3 pr-3"><u>Edit My Meal Plan</u></a>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid mt-3">

		<div class="row">
			<div class="col-12">
				<div class="ourentrees-breakfast mb-5">
					<div class="tab-content pt-3">
						@foreach($categories as $category)
							<div class="tab-pane @if($loop->first) active @endif" id="category_{{$category->id}}" role="tabpanel">
								<div class="row">
									@foreach($meals as $meal)
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="menucol rounded mt-3 shadow pb-3" style="cursor: pointer;">
												<div class="menuimgcol">
													<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
														<div class="carousel-inner" role="listbox">
															@foreach($meal->images as $image)
																<div class="carousel-item @if($loop->index==0) {{'active'}} @endif">
																	<img class="img-fluid rounded w-100 d-block" src="{{$image->file}}" alt="First slide">
																</div>
															@endforeach
														</div>

														<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
															<i class="fa fa-chevron-left"></i>
															<span class="sr-only">Previous</span>
														</a>
														<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
															<i class="fa fa-chevron-right"></i>
															<span class="sr-only">Next</span>
														</a>
													</div>
												</div>
												<div class="menucoltext p-2">
													<div class="menucoltextpricebtn">
														<div class="menucoltextprice">
															<div class="d-flex">
																<p class="m-0">
																	<del>$ {{ $meal->items()->sum('selling_price') }}</del>
																</p>
																<h5 class="font-weight-bold m-0 text-color ml-2">
																	$ {{ $meal->items()->sum('selling_price') }}</h5>
															</div>
														</div>
														<div class="menucoltextbtn">
															<button type="button" onclick="addItem('{{$day}}',{{$meal->id}});" class="btn btn-info btn-md float-right">
																Add
															</button>
														</div>
													</div>
													<h5 class="mb-1 text-color text-center" data-toggle="modal" data-target="#meal_details_{{$meal->id}}">{{ $meal->name }}</h5>
													<p class="m-0 text-center" data-toggle="modal" data-target="#meal_details_{{$meal->id}}">{{ $meal->name }}</p>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						@endforeach

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
									@if($meal->images->count()>0)
										<img src="{{$meal->images->first()->file}}" class="img-fluid w-100 rounded d-block">
									@else
										<img src="" class="img-fluid w-100 rounded d-none">
									@endif

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
								<p class="mb-1 pb-2 border-bottom">Calories (Kcal)
									<span class="font-weight-bold float-right text-color">{{$meal->items->sum('calories')}}</span>
								</p>
								<p class="mb-1 pb-2 border-bottom">Total Fat (Grams)<span class="font-weight-bold float-right text-color">{{$meal->items->sum('fat')}}</span>
								</p>
								<p class="mb-1 pb-2 border-bottom">Total Carbohydrates (Grams)
									<span class="font-weight-bold float-right text-color">{{$meal->items->sum('carbs')}}</span>
								</p>
								<p class="mb-1 pb-2 border-bottom">Total Protein (Grams)
									<span class="font-weight-bold float-right text-color">{{$meal->items->sum('protein')}}</span>
								</p>
								<p>* Present Daily values are based on 2,000 calories diet. Your daily values may be higher or lower depending on your calories need.</p>
							</div>
						</div>
					</div>
					<div class="modal-footer p-0 justify-content-left">
						<button type="button" class="btn btn-dark btn-md" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	@endforeach

@endsection
@section('script')
	<script type="text/javascript" src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/Cart.js') }}"></script>
	<script>
		$(".select2").select2({
			placeholder: "Filter....",
			allowClear: true
		});
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		handleFilterChanged = (value) => {
			$('#filter_form').submit();
		};
	</script>
@endsection