<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_english' => 'required',
            'name_bangla' => 'required',
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

    function messages()
    {
        return [
            'name_english.required' => trans('labels.This field is required'),
            'name_bangla.required' => trans('labels.This field is required'),
        ];
    }
}
