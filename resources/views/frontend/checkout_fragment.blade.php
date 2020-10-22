<div class="form-group d-none">
	<div class="custom-control custom-radio">
		<input type="radio" class="custom-control-input" id="monthly" name="payment_slab" value="monthly" @if($state->paymentSlab()==\App\Core\Enums\Common\PaymentSlab::Monthly) checked @endif>
		<label class="custom-control-label" for="monthly"><span style="font-size: 18px; font-weight: 600;" class="text-color">Pay monthly</span></label>
	</div>

	<div class="custom-control custom-radio mt-3">
		<input type="radio" class="custom-control-input" id="weekly" name="payment_slab" value="weekly" @if($state->paymentSlab()==\App\Core\Enums\Common\PaymentSlab::Weekly) checked @endif>
		<label class="custom-control-label" for="weekly"><span style="font-size: 18px; font-weight: 600;" class="text-color">Pay weekly</span></label>
	</div>
</div>

<div class="d-none">
	<hr>
	<h6 class="font-weight-bold text-color">Your weekly subscription:</h6>
	@if($state->wantBreakfast()&&$state->wantSnacks())
		<p>{{$state->getMealsPerDay()}} meal(s), breakfast and {{$state->snackCount()}} snack(s) every week day.</p>
	@elseif($state->wantBreakfast())
		<p>{{$state->getMealsPerDay()}} meal(s) & breakfast every week day.</p>
	@elseif($state->wantSnacks())
		<p>{{$state->getMealsPerDay()}} meal(s) & {{$state->snackCount()}} snack(s) every week day.</p>
	@else
		<p>{{$state->getMealsPerDay()}} meal(s) every week day.</p>
	@endif
</div>
<hr>
@if($state->staffDiscount())
	<h6>
		25% off as extra discount (Students/Staff)<span class="font-weight-bold text-color float-right"></span>
	</h6>
	<hr>
@endif
<p id="couponFrame">
	@include('frontend.coupon_frame',['coupon'=>$state->coupon()])
</p>
<p>
	Sub total<span class="float-right font-weight-bold">&pound;{{sprintf("%.2f",$state->subTotal())}}</span>
</p>
<p>
	Grand total<span class="float-right font-weight-bold">&pound;{{sprintf("%.2f",$state->total())}}</span>
</p>