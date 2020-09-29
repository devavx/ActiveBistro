<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEditItemRule extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize ()
	{
		return True;
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
			'item_type_id' => 'required',
			'category_id' => 'required',
			'ingredient_id' => 'required',
			'thumbnail' => 'image',
		];
	}
}
