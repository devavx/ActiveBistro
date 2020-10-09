@extends('layouts.master')
@section('title') Active Bistro | Options @endsection
@section('css')
	<style type="text/css">
        .invalid-feedback {
            display: block !important;
        }

        .error {
            color: red;
        }
	</style>
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-sm-10 col-12 mx-auto">
				<form id="msform" class="shadow p-3 mt-5 mb-5 checkoutprocess" method="post" action="{{route('cart.checkout.store')}}">
					@csrf
					<ul id="progressbar">
						<li class="active" id="account"><strong>Order</strong></li>
						<li id="personal"><strong>Details</strong></li>
						<li id="payment-status"><strong>Delivery</strong></li>
						<li id="payment"><strong>Checkout</strong></li>
					</ul>

					<fieldset class="px-2">

						<div class="form-group">
							<label>Your email address <sup class="text-danger">*</sup></label>
							<input type="email" class="form-control" value="{{auth()->user()->email}}" readonly>
						</div>

						<div class="form-group">
							<label>First Name <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" value="{{auth()->user()->first_name}}" readonly>
						</div>

						<div class="form-group">
							<label>Last Name <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" value="{{auth()->user()->last_name}}" readonly>
						</div>

						<div class="form-group">
							<label>Contact number (used for delivery notifications)
								<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" value="{{auth()->user()->phone}}" readonly>
						</div>

						<button type="button" class="btn btn-info btn-block ml-0 next rounded">Sign up</button>
						<p class="text-center"><a href="login.html" class="text-color">Already have an Account?
								Login</a>
						</p>
					</fieldset>

					<fieldset class="px-2">

						<div class="form-group">
							<h6 class="mb-1 font-weight-bold text-color">1. Choose your delivery start date</h6>
							<p>Your food is delivered to your door twice a week every Sunday and Wednesday ensuring
								freshness.</p>
						</div>

						<div class="date-selection mb-3">
							@foreach(dates() as $date)
								<label class="date-label" for="radio_{{$date['date']}}">
									<span>{{$date['day']}}</span>
									<span class="bigger">{{$date['date']}}</span>
									<span>{{$date['month']}}</span>
									<input class="hidden" type="checkbox" id="radio_{{$date['date']}}" name="dates[]" value="radio_{{$loop->index}}">
								</label>
							@endforeach
						</div>

						<div class="form-group">
							<h6 class="mb-1 font-weight-bold text-color">2. Delivery address</h6>
							<p>Your food is delivered to your door twice a week every Sunday and Wednesday ensuring freshness.</p>
						</div>
						<div id="sunday_address">
							<div class="form-group">
								<label>Address Line 1</label>
								<input type="text" class="form-control" name="address[sunday][address_first_line]" data-parsley-group='["sunday_address","address"]' required minlength="2" maxlength="100">
							</div>

							<div class="form-group">
								<label>Address Line 2</label>
								<input type="text" class="form-control" name="address[sunday][address_second_line]" data-parsley-group='["sunday_address","address"]' minlength="2" maxlength="100">
							</div>

							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Town / City</label>
										<input type="text" class="form-control" name="address[sunday][city]" minlength="1" data-parsley-group='["sunday_address","address"]' maxlength="50" required>
									</div>
								</div>

								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Postcode</label>
										<select name="address[sunday][postcode]" id="" class="form-control" data-parsley-group='["sunday_address","address"]' required>
											<option value="">Choose...</option>
											@foreach($postalCodes as $code)
												<option value="{{$code->name}}">{{$code->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Delivery Notes</label>
								<textarea class="form-control" rows="3" name="address[sunday][delivery_notes]" data-parsley-group='["sunday_address","address"]'></textarea>
							</div>
						</div>
						<div id="wednesday_address">
							<div class="form-group">
								<h6 class="mb-1 font-weight-bold text-color">Wednesday Deliveries</h6>
							</div>
							<div class="form-group">
								<label>Address Line 1</label>
								<input type="text" class="form-control" name="address[wednesday][address_first_line]" data-parsley-group="address" minlength="2" maxlength="100">
							</div>

							<div class="form-group">
								<label>Address Line 2</label>
								<input type="text" class="form-control" name="address[wednesday][address_second_line]" data-parsley-group="address" minlength="2" maxlength="100">
							</div>
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Town / City</label>
										<input type="text" class="form-control" name="address[wednesday][city]" minlength="1" data-parsley-group="address" maxlength="50">
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Postcode</label>
										<select name="address[wednesday][postcode]" id="" class="form-control" data-parsley-group="address">
											<option value="">Choose...</option>
											@foreach($postalCodes as $code)
												<option value="{{$code->name}}">{{$code->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Delivery Notes</label>
								<textarea class="form-control" rows="3" name="address[wednesday][delivery_notes]" data-parsley-group="address"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="differentAddresses" name="separate_addresses">
								<label class="custom-control-label" for="differentAddresses">Choose different addresses for your Sunday and Wednesday deliveries.</label>
							</div>
						</div>

						<button type="button" class="btn btn-info btn-block ml-0 next rounded" data-group="address">Checkout</button>

					</fieldset>

					<fieldset class="px-2">
						<div class="form-group">
							<p>This is a flexible subscription service. You can edit, pause or cancel your plan at any point in time after purchase.</p>
						</div>

						<div class="form-group">
							<div class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" id="monthly" name="payment_slab" value="monthly" checked>
								<label class="custom-control-label" for="monthly"><span style="font-size: 18px; font-weight: 600;" class="text-color">Pay monthly</span>
									<br>Get <span class="text-color">10%</span> off when you go monthly.</label>
							</div>

							<div class="custom-control custom-radio mt-3">
								<input type="radio" class="custom-control-input" id="weekly" name="payment_slab" value="weekly">
								<label class="custom-control-label" for="weekly"><span style="font-size: 18px; font-weight: 600;" class="text-color">Pay weekly</span></label>
							</div>
						</div>

						<hr>

						<h6 class="font-weight-bold text-color">Your weekly subscription:</h6>
						<p>{{$state->getMealsPerDay()}} meals & 1 snack every week day.</p>

						<hr>

						<h6>10% off your first two weeks promo
							<span class="font-weight-bold text-color float-right">&pound; {{$rebates->weekRebate->calculated}}</span>
						</h6>
						<p>Week 1 discount<span class="float-right font-weight-bold">&pound; {{$rebates->firstWeekRebate->calculated}}</span>
						</p>
						<p>Week 2 discount<span class="float-right font-weight-bold">&pound; {{$rebates->secondWeekRebate->calculated}}</span>
						</p>

						<hr>
						<h6>Delivery cost per week (First delivery 26th July)<span class="font-weight-bold text-color float-right">Free</span>
						</h6>
						<hr>
						@if(isset($rebates->staffRebate))
							<h6>
								25% off as extra discount (Students/Staff)<span class="font-weight-bold text-color float-right">&pound; {{$rebates->staffRebate->calculated}}</span>
							</h6>
							<hr>
						@endif
						@if(isset($rebates->coupon))
							<h6>
								{{$rebates->coupon->coupon->discount}}% using coupon {{$rebates->coupon->coupon->code}}
								<span class="font-weight-bold text-color float-right">&pound; {{$rebates->staffRebate->calculated}}</span>
							</h6>
							<hr>
						@endif

						<p>Total per week<span class="float-right font-weight-bold">&pound; {{$state->total()}}</span>
						</p>
						<p>(Total after temporary discount(s) expire)<span class="float-right font-weight-bold">&pound; {{$state->subTotal()}}</span>
						</p>

						<p>
							@include('frontend.coupon_frame',['coupon'=>$state->coupon()])
						</p>

						<p class="text-center">
							<a href="{{route('cart.index')}}" class="btn border btn-block ml-0">Change your order</a>
						</p>

						<div class="custom-control custom-checkbox ">
							<input type="checkbox" class="custom-control-input" id="agree" name="agreement" required>
							<label class="custom-control-label" for="agree">You have read and agree to our T&C's</label>
						</div>

						<button type="submit" class="btn btn-info btn-block ml-0 rounded">Place your order</button>

					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="couponModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Have a coupon?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="couponForm">
					<div class="modal-body">
						<div class="form-row">
							<div class="col-12">
								<input type="text" class="form-control" id="coupon-code" required minlength="2" maxlength="50">
								<div class="valid-feedback" id="validationMessage"></div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-block btn-info rounded waves-effect waves-light m-0">Apply</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection
@section('script')
	<script src="{{asset("js/parsley.js")}}"></script>

	<script>
		$("#coupantoggle").click(function () {
			$("#showcoupantextfield").toggle();
		});
	</script>

	<script>
		let current_fs, next_fs, previous_fs, opacity;

		$(document).ready(function () {
			$(".next:first").trigger('click');

			$('#wednesday_address').hide();
			$('#differentAddresses').change(function () {
				if (this.checked) {
					$('#wednesday_address').show(600);
					$('#wednesday_address :input').prop('required', true);
				} else {
					$('#wednesday_address').hide(600);
					$('#wednesday_address :input').prop('required', false);
				}
			});

			$(".date-label").click(function () {
				const current = $(this);
				const next = $(this).next();
				const previous = $(this).prev();
				current.addClass("dateselectradio");
				current.children("input:checkbox").attr("checked", true);
				current.siblings().removeClass("dateselectradio");
				current.siblings("input:checkbox").attr("checked", false);
				next.addClass("dateselectradio");
				next.children("input:checkbox").attr("checked", true);
				previous.removeClass("dateselectradio");
				previous.children("input:checkbox").attr("checked", false);
			});
		});

		$(".next").click(function (e) {
			const ref = this;
			const group = e.currentTarget.getAttribute('data-group');
			console.log(group);
			switch (group) {
				case 'address':
					if ($('#differentAddresses:checked').length > 0) {
						$('#msform').parsley().whenValidate({
							group: 'address'
						}).done(function () {
							console.log('Is valid when not checked');
							moveToNext(ref);
						});
					} else {
						$('#msform').parsley().whenValidate({
							group: 'sunday_address'
						}).done(function () {
							console.log('Is valid when checked');
							moveToNext(ref);
						});
					}
					break;

				default:
					moveToNext(ref);
					break;
			}
		});

		moveToNext = (e) => {
			current_fs = $(e).parent();
			next_fs = $(e).parent().next();
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
			next_fs.show();
			current_fs.animate({opacity: 0}, {
				step: function (now) {
					opacity = 1 - now;
					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({'opacity': opacity});
				},
				duration: 600
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#couponForm').submit(function (event) {
				event.preventDefault();
				setLoading(true, () => {
					performPut({
						url: '/cart/coupon/',
						data: JSON.stringify({
							coupon: $('#coupon-code').val()
						}),
						success: (message, data) => {
							notyf.success(message);
						},
						failed: (message) => {
							notyf.error(message);
						},
						complete: () => {
							setLoading(false);
						},
						before: () => {
							$('#couponModal').modal('hide');
						},
					});
				});
			});
		});

		function makeCouponText() {

		};

		function removeCoupon() {

		};
	</script>
@endsection