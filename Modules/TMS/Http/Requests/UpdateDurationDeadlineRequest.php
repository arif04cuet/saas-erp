<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDurationDeadlineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'registration_deadline' => 'required|before:start_date',
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
            'registration_deadline.required' => trans('labels.This field is required'),
            'end_date.after_or_equal' => trans('labels.end_date_greater_than_or_equal_start_date'),
            'registration_deadline.before' => trans('tms::training.messages.registration_deadline.before'),
        ];
    }

}
