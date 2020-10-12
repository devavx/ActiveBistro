@if($coupon!=null)
	<span id="couponText">{{$coupon->code}}</span>
	<a class="text-color" href="javascript:removeCoupon();" id="removeLink"> Remove</a>
@else
	<span id="couponText">Referred by a friend or got a coupon?</span>
	<a class="text-color" data-toggle="modal" data-target="#couponModal" href="javascript:void(0);" id="applyLink"> Click here</a>
@endif
<hr>