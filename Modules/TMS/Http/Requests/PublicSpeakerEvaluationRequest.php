<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicSpeakerEvaluationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'trainee_id' => 'required|exists:trainees,id',
            'training_course_id' => 'required|exists:training_courses,id',
            'training_course_resource_id' => 'required|exists:training_course_resources,id',
            'training_course_module_session_id' => 'required|exists:training_course_module_sessions,id',
            'recommendation' => 'nullable|max:255',
            'good_parts' => 'nullable|max:255',
            'score' => 'required',
            'assessmentQA' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */

    public function messages()
    {
        return [
            'trainee_id.required'=> trans('labels.This field is required'),
            'trainee_id.exists'=> trans('labels.At most 255 characters'),

            'training_course_id.required'=> trans('labels.This field is required'),
            'training_course_id.exists'=> trans('labels.At most 255 characters'),

            'training_course_resource_id.required'=> trans('labels.This field is required'),
            'training_course_resource_id.exists'=> trans('labels.At most 255 characters'),

            'training_course_module_session_id.required'=> trans('labels.This field is required'),
            'training_course_module_session_id.exists'=> trans('labels.At most 255 characters'),

            'recommendation.max'=> trans('labels.At most 255 characters'),
            'good_parts.max'=> trans('labels.At most 255 characters'),

            'score.required'=> trans('labels.This field is required'),
            'assessmentQA.required'=> trans('labels.This field is required')
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
