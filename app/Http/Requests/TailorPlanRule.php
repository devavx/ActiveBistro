<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TailorPlanRule extends FormRequest
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
            'user_height'=>'required',
            'weight_total'=>'required',
            'user_weight'=>'required',
            'user_targert_weight'=>'required',
            'weight_goal'=>'required',
            'activity_lavel'=>'required',
        ];
    }
}
