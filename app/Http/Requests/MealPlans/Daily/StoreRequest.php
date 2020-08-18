<?php

namespace App\Http\Requests\MealPlans\Daily;

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
            'name' => 'required|unique:meal_plans',
            'images.*' => 'bail|required|image|max:2048',
            'item_id.*' => 'bail|required',
            'day' => 'bail|required|string',
            'type' => 'bail|required|string',
        ];
    }
}
