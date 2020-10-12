<?php

namespace App\Http\Requests\MealPlans\Fixed;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	        'name' => 'bail|required',
	        'images.*' => 'bail|required|image|max:2048',
	        'item_id.*' => 'bail|required',
	        'allergy_id.*' => 'bail|required',
	        'type' => 'bail|nullable|string',
	        'default_slab_1' => 'bail|required',
	        'default_slab_2' => 'bail|required',
	        'default_slab_3' => 'bail|required',
        ];
    }
}
