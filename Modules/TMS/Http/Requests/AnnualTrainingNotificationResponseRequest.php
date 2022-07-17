<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnualTrainingNotificationResponseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'response.*.title' => 'required|max:500',
            'response.*.no_of_trainee' => 'required|max:5000',
            'response.*.participant_type' => 'required|max:500',
            'response.*.remark' => 'nullable',
            'response.*.start_date' => 'date_format:"Y-m-d"|before_or_equal:response.*.end_date|required',
            'response.*.end_date' => 'date_format:"Y-m-d"|after_or_equal:response.*.start_date|required',
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
            'response.*.title.required' => trans('labels.This field is required'),
            'response.*.no_of_trainee.required' => trans('labels.This field is required'),
            'response.*.no_of_trainee.max' => trans('labels.max_length_validation_message', ['length' => 5000]),
            'response.*.participant_type.required' => trans('labels.This field is required'),
            'response.*.participant_type.max' => trans('labels.max_length_validation_message', ['length' => 500]),
            'response.*.start_date.before_or_equal' => trans('labels.start_date_greater_than_or_equal_end_date'),
            'response.*.start_date.required' => trans('labels.This field is required'),
            'response.*.end_date.after_or_equal' => trans('labels.end_date_greater_than_or_equal_start_date'),
            'response.*.end_date.required' => trans('labels.This field is required'),
        ];
    }

}
