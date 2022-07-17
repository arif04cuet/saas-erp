<?php

namespace Modules\VMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:500',
            'model' => 'required|max:500',
            'registration_number' => 'required|max:500',
            'price' => 'required|numeric',
            'seat' => 'required|max:500',
            'cc' => 'required|max:500',
            'chassis_number' => 'required|numeric',
            'purchase_date' => 'required',
            'vehicle_type_id' => 'required',
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
            'required' => trans('labels.This field is required'),
            'max' => trans('labels.max_length_validation_message', ['length' => 500]),
            'numeric' => trans('labels.only_integer_number'),
        ];
    }


}
