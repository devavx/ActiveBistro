<?php

namespace App\Http\Requests\MealPlans\Daily;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'images.*' => 'bail|sometimes|image|max:2048',
            'item_id.*' => 'bail|required',
            'day' => 'bail|required|string',
            'type' => 'bail|required|string',
            'default_slab_1' => 'bail|required',
            'default_slab_2' => 'bail|required',
            'default_slab_3' => 'bail|required',
        ];
    }
}
