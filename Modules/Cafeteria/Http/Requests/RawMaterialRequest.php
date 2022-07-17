<?php

namespace Modules\Cafeteria\Http\Requests;


use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class RawMaterialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'bn_name' => 'required',
                'en_name' => 'required',
                'type' => 'required',
                'short_code' => 'unique:raw_materials,short_code,' . $id['raw_material']
            ];
        } else {
            return [
                'bn_name' => 'required',
                'en_name' => 'required',
                'type' => 'required',
                'short_code' => 'unique:raw_materials,short_code'
            ];
        }  
    }

    public function messages()
    {
        return [
            'short_code.unique' => trans('cafeteria::raw-material.short_code_msg'),
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
