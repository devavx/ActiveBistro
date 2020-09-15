<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
	public function rules (): array
	{
		return [
			'payment_slab' => $this->paymentSlabRules(),
		];
	}

	public function paymentSlab (): string
	{
		return request('payment_slab');
	}

	public function hasSeparateAddresses (): bool
	{
		return request()->has('separate_addresses');
	}

	public function addresses (): array
	{
		$addresses = $this->get('address');
		return [
			$addresses['sunday'],
			$addresses['wednesday']
		];
	}

	public function address (): array
	{
		return ($this->get('address'))['sunday'];
	}

	protected function paymentSlabRules (): array
	{
		return [
			'bail',
			'required',
			Rule::in(['monthly', 'weekly'])
		];
	}
}