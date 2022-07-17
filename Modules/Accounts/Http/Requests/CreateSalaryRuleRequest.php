<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSalaryRuleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'bangla_name' => 'required|max:255',
            'salary_category_id' => 'required',
            'code' => 'required|max:50|unique:salary_rules,code',
            'sequence' => 'required|max:50',
            'quantity' => 'required|max:50',

        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.max' => __('labels.At most 100 characters'),
            'bangla_name.max' => __('labels.At most 255 characters'),
            'code.max' => __('labels.At most 50 characters'),
            'code.unique' => __('validation.unique', ['attribute' => __('labels.code')]),
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
