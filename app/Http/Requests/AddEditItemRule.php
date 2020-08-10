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
    public function authorize()
    {
        return True;
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
            // 'sub_name'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'protein'=>'required',
            'protein'=>'required',
            'calories'=>'required',
            'carbs'=>'required',
            'item_type_id'=>'required',
            'category_id'=>'required',
            'ingredient_id'=>'required',
            'thumbnail'=>'image',
        ];
    }
}
