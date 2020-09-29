<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize ()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules ()
	{
		return [
			'name' => 'bail|required|string|min:2|max:255',
			'short_description' => 'bail|required|string|min:2|max:255',
			'long_description' => 'bail|required|string|min:2|max:1000',
			'protein' => 'bail|required|numeric|min:0.00|max:10000.00',
			'calories' => 'bail|required|numeric|min:0.00|max:10000.00',
			'carbs' => 'bail|required|numeric|min:0.00|max:10000.00',
			'fat' => 'bail|required|numeric|min:0.00|max:10000.00',
			'item_type_id' => 'bail|required|exists:item_types,id',
			'category_id' => 'bail|required|exists:categories,id',
			'ingredient_id' => 'bail|required|exists:ingredients,id',
			'thumbnail' => 'bail|sometimes|image|max:4096',
		];
	}
}
