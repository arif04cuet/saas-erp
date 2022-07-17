<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingHeadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_english' => 'required',
            'title_bangla' => 'required',
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
            'title_english.required' => trans('labels.This field is required'),
            'title_bangla.required' => trans('labels.This field is required'),
            'training_sponsor_id.required' => trans('labels.This field is required'),
            'training_participant_type_id.required' => trans('labels.This field is required'),
            'level.required' => trans('labels.This field is required')
        ];
    }


}
