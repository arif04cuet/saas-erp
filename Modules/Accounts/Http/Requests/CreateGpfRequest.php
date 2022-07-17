<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGpfRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required|unique:gpf_records,employee_id|exists:employee_contracts,employee_id',
            'fund_number' => 'required|unique:gpf_records,fund_number',
            'start_date' => 'required',
            'current_percentage' => 'required|numeric|min:10|max:25',
            'stock_balance' => 'required|numeric',
            'current_balance' => 'required|numeric',
            'remark' => 'max:255'
        ];
    }

    public function messages()
    {
        return [
            'employee_id.exists' => __('accounts::gpf.no_contract')
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
