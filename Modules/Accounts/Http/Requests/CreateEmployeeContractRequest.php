<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeContractRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reference' => 'required|max:255',
            'employee_id' => 'required',
            'salary_structure_id' => 'required',
            'salary_grade' => 'required',
            'start_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'reference.max' => __('labels.At most 255 characters')
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
