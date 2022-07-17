<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeReligionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bengali_title' => 'required|max:255',
            'english_title' => 'required|max:255',
            'description' => 'nullable|max:500',
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

    public function messages()
    {
        return [
            'bengali_title.required' => trans('labels.This field is required'),
            'bengali_title.max' => trans('labels.At most 255 characters'),
            'english_title.required' => trans('labels.This field is required'),
            'english_title.max' => trans('labels.At most 255 characters'),
            'description.max' => trans('labels.At most 500 characters'),
        ];
    }
}
