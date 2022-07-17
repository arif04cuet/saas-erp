<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'temperature'   =>"required|numeric|max:108|min:1", 
            'pulse'         =>"required|numeric|min:1", 
            'respiration'   =>"required|numeric|min:1", 
            'conjunctiva'   =>"required|max:50", 
            'oral_cavity'   =>"required|max:50", 
            'denture'       =>"required|max:50", 
            'blood_pressure'=>"required|max:50", 
            'anaemia'       =>"required|max:50", 
            'oedema'        =>"required|max:50", 
            'heart'         =>"required|max:50", 
            'lung'          =>"required|max:50", 
            'abdomen'       =>"required|max:50", 
            'eye_sight'     =>"required|max:50", 
            'left_eye'      =>"required|max:50", 
            'right_eye'     =>"required|max:50"
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
            'required.temperature'  => trans('labels.This field is required'),
            'numeric.temperature'   => trans('labels.number'),
            'min.temperature'       => trans('labels.number_min'),
            'max.temperature'       => trans('labels.temp_max'),

            'required.pulse'        => trans('labels.This field is required'),
            'numeric.pulse'         => trans('labels.number'),
            'min.pulse'             => trans('labels.number_min'),

            'required.respiration'  => trans('labels.This field is required'),
            'numeric.respiration'   => trans('labels.number'),
            'min.respiration'       => trans('labels.number_min'),

            'required.conjunctiva'   => trans('labels.This field is required'),
            'required.oral_cavity'   => trans('labels.This field is required'),
            'required.denture'       => trans('labels.This field is required'),
            'required.blood_pressure'=> trans('labels.This field is required'),
            'required.anaemia'       => trans('labels.This field is required'),
            'required.oedema'        => trans('labels.This field is required'),
            'required.heart'         => trans('labels.This field is required'),
            'required.lung'          => trans('labels.This field is required'),
            'required.abdomen'       => trans('labels.This field is required'),
            'required.eye_sight'     => trans('labels.This field is required'),
            'required.left_eye'      => trans('labels.This field is required'),
            'required.right_eye'     => trans('labels.This field is required'),

            'max.conjunctiva'   => trans('labels.max_lenght'),
            'max.oral_cavity'   => trans('labels.max_lenght'),
            'max.denture'       => trans('labels.max_lenght'),
            'max.blood_pressure'=> trans('labels.max_lenght'),
            'max.anaemia'       => trans('labels.max_lenght'),
            'max.oedema'        => trans('labels.max_lenght'),
            'max.heart'         => trans('labels.max_lenght'),
            'max.lung'          => trans('labels.max_lenght'),
            'max.abdomen'       => trans('labels.max_lenght'),
            'max.eye_sight'     => trans('labels.max_lenght'),
            'max.left_eye'      => trans('labels.max_lenght'),
            'max.right_eye'     => trans('labels.max_lenght'),
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
