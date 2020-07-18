<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class MealPlanRules extends FormRequest
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
             'name'=>'required',
             'no_of_days'=>'required',
             'rate_per_item'=>'required',
             'rate_per_item_three_days'=>'required',
             'meal_in_two_days'=>'required',
             'meal_in_three_days'=>'required',
        ];
    }
}
