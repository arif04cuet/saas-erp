<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        // dd('di');
        return [
            'name_en' => 'required|max:200',
            'name_bn' => 'required|max:200',
            'slug' => 'required|max:200',
            'short_code' => 'required|max:100|unique:modules,short_code,'.$this->id,
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

            'name_en.required' => trans('module.msg.requied'),
            'name_en.max' => trans('module.msg.max'),

            'name_bn.required' => trans('module.msg.requied'),
            'name_bn.max' => trans('module.msg.max'),

            'short_code.required' => trans('module.msg.requied'),
            'short_code.max' => trans('module.msg.max'),
            'short_code.unique' => trans('module.msg.unique'),

            'slug.required' => trans('module.msg.requied'),
            'slug.max' => trans('module.msg.max'),
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
