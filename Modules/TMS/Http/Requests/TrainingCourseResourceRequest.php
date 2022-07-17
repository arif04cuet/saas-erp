<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingCourseResourceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_resources' => 'required',
            'employee_resources.*.employee_id' => 'required|exists:employees,id|distinct',
            'employee_resources.*.employee_short_name' => 'required|max:255',
            'employee_resources.*.should_be_evaluated' => 'nullable',
            'guest_resources.*.first_name' => 'required|max:255',
            'guest_resources.*.last_name' => 'required|max:255',
            'guest_resources.*.short_name' => 'required|max:255',
            'guest_resources.*.mobile_no' => 'required|max:11|distinct',
            'guest_resources.*.email' => 'required|email|distinct',
            'guest_resources.*.should_be_evaluated' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'guest_resources.*.first_name.required' => trans('labels.This field is required'),
            'guest_resources.*.last_name.required' => trans('labels.This field is required'),
            'guest_resources.*.short_name.required' => trans('labels.This field is required'),
            'guest_resources.*.mobile_no.required' => trans('labels.This field is required'),
            'guest_resources.*.email.required' => trans('labels.This field is required'),
            'guest_resources.*.first_name.max' => trans('labels.At most 255 characters'),
            'guest_resources.*.last_name.max' => trans('labels.At most 255 characters'),
            'guest_resources.*.short_name.max' => trans('labels.At most 255 characters'),
            'guest_resources.*.mobile_no.max' => trans('labels.At least 11 characters'),
            'guest_resources.*.mobile_no.distinct' => trans('labels.At least 11 characters'),
            'guest_resources.*.email.email' => trans('labels.Please enter a valid email address'),
            'guest_resources.*.email.distinct' => trans('labels.Please enter a valid email address'),
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
