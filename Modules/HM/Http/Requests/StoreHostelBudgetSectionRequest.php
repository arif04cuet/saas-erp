<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreHostelBudgetSectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'title_english' => 'required',
            'title_bangla' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_english.required' => trans('labels.This field is required'),
            'title_bangla.unique' => trans('labels.This field is required')
        ];
    }
}
