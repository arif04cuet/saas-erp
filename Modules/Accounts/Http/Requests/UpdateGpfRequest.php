<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateGpfRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
       $fundNoRule = ($request->existing_fund_no != $request->fund_number)? '|unique:gpf_records,fund_number' : '';
        return [
            'employee_id' => 'required|exists:employee_contracts,employee_id',
            'fund_number' => 'required'.$fundNoRule,
            'start_date' => 'required',
            'current_percentage' => 'required|numeric|min:10|max:25',
            'stock_balance' => 'required|numeric',
            'current_balance' => 'required|numeric',
            'remark' => 'max:255'
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
