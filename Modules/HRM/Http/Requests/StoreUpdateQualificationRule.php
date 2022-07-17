<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateQualificationRule extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'min_ssc_year' => "required",
            'min_hsc_year' => "required",
            'min_grad_year' => "required",
            'min_post_grad_year' => "nullable",
            'ssc_point' => 'required|numeric|min:1|max:5',
            'hsc_point' => 'required|numeric|min:1|max:5',
            'grad_point' => 'required|numeric|min:1|max:4',
            'post_grad_point' => 'nullable|numeric|min:1|max:4',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
