@extends('layouts.master')
@section('title') Active Bistro | All Meals @endsection
@section('css')
	<link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
	<link href="{{ asset("assets/node_modules/select2/dist/css/select2.min.css") }}" rel="stylesheet" type="text/css"/>
	<style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000 !important;
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

	<div class="bg-color p-2 mt-3">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-8 col-sm-8 col-12">
							<h5 class="text-white pt-3 font-weight-bold">Your tailored meal plan</h5>
						</div>

						<div class="col-lg-4 col-sm-4 col-12 my-auto">
							<div class="form-group mb-0">
								<label class="text-white mb-0">{{!empty($state->getDietaryRequirement())&&$state->getDietaryRequirement()!=\App\Core\Enums\Common\DietaryRequirement::None?\App\Core\Enums\Common\DietaryRequirement::displayName($state->getDietaryRequirement()):\App\Core\Primitives\Str::Empty}}</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="main_container">
		@include('frontend.main_container',['state'=>$state])
	</div>
@endsection
@section('script')
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/js/owl.carousel.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/Cart.js') }}"></script>
	<script type="text/javascript">
		function editdata(id) {
			console.log(id);
			$("#mealcol__" + id).hide();
			$("#meal-form__" + id).show();
		}

		function saveData(id) {
			console.log(id);
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
					loop: true,
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
							loop: true
						},
						768: {
							items: 2,
							nav: false,
							loop: true
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