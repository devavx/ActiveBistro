<?php

namespace App\Http\Requests\Checkout;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
	public function rules ()
	{
		return [

		];
	}

	public function coupon (): ?Coupon
	{
		if (request('coupon', null) == null) {
			return null;
		}
		return Coupon::query()->where('code', request('coupon'))->first();
	}
}