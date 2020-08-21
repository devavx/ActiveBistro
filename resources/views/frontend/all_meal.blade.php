@extends('layouts.master')
@section('title') Active Bistro | All Meals @endsection
@section('css')
	<link href="{{ asset("assets/node_modules/select2/dist/css/select2.min.css") }}" rel="stylesheet" type="text/css"/>
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
							<a href="checkoutprocess.html" class="btn btn-info btn-lg">Securely checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/js/owl.carousel.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/Cart.js') }}"></script>
	<script type="text/javascript">
		function editdata(id) {
			$("#mealcol__" + id).hide();
			$("#meal-form__" + id).show();
		}

		function saveData(id) {
			$("#meal-form__" + id).hide();
			$("#mealcol__" + id).show();
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
			// var totalAmount = 0;
			// // alert($('p.item__price').length);
			// $('.item_meal_section .meal__item__count p').each(function () {
			// 	// $(this).parent().attr('data-lity','');
			// 	totalAmount += parseFloat($(this).attr('data-price'));
			// 	// alert($(this).attr('data-price'));
			// });
			// // alert(totalAmount);
			//
			// $('#total_weekly_amout').html(totalAmount);
		}

		function changeItem(mealId, itemElement, element) {
			console.log(element.value);
			var selectedItemName = $(element).find("option:selected").data("item")
			var selectedItemPrice = $(element).find("option:selected").data("price")
			console.log(selectedItemName);
			var selectedItemId = $('option:selected').val();

			// alert(selectedItemId);
			// alert(selectedItem);
			// alert(itemElement);
			$('#' + itemElement).html(selectedItemName);
			$('#price__' + itemElement).html(selectedItemPrice);
		}
	</script>

@endsection