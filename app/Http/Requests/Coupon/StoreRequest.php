<?php

namespace App\Http\Requests\Coupon;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
	public function rules ()
	{
		return [
			'code' => ['bail', 'required', 'string', 'min:4', 'max:50', 'unique:coupons,code'],
			'description' => ['bail', 'nullable', 'string', 'max:1000'],
			'usage_count' => ['bail', 'nullable', 'numeric', 'min:1', 'max:1000000'],
			'discount' => ['bail', 'required', 'numeric', 'min:1', 'max:100'],
			'type' => ['bail', 'required', 'string', Rule::in([Coupon::Flat, Coupon::Percent])],
			'promote' => ['bail', 'required', 'boolean'],
			'valid_from' => ['bail', 'required', 'date'],
			'valid_until' => ['bail', 'required', 'after:valid_from'],
		];
	}

	public function convert (): array
	{
		return [
			'code' => $this->validated()['code'],
			'description' => $this->validated()['description'],
			'usage_count' => $this->validated()['usage_count'],
			'discount' => $this->validated()['discount'],
			'type' => $this->validated()['type'],
			'promote' => $this->validated()['promote'],
			'valid_from' => date('Y-m-d', strtotime($this->validated()['valid_from'])),
			'valid_until' => date('Y-m-d', strtotime($this->validated()['valid_until'])),
		];
	}

	public function wantsPromotion (): bool
	{
		return $this->validated()['promote'] == 1;
	}
}