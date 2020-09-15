<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	public function rules (): array
	{
		return [

		];
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
}