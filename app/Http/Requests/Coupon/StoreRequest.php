<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	public function rules ()
	{
		return [
			'code' => ['bail', 'required', 'string', 'min:4', 'max:50', 'unique:coupons,code'],
			'description' => ['bail', 'nullable', 'string', 'max:1000'],
			'valid_from' => ['bail', 'required', 'date'],
			'valid_until' => ['bail', 'required', 'after:valid_from'],
		];
	}

	public function convert (): array
	{
		return [
			'code' => $this->validated()['code'],
			'description' => $this->validated()['description'],
			'valid_from' => date('Y-m-d', strtotime($this->validated()['valid_from'])),
			'valid_until' => date('Y-m-d', strtotime($this->validated()['valid_until'])),
		];
	}
}