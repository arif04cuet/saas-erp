<?php

namespace Modules\Accounts\Http\Requests;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateGpfLoanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required',
            'sanction_date' => 'required',
            'amount' => 'required|numeric|min:1|lte:max_loan',
            'no_of_installment' => 'required|numeric|min:1',
            'current_balance' => 'numeric|lte:amount',
            'remark' => 'max:255'
        ];
    }

    public function messages()
    {
        return [
            'amount.min' => __('validation.min.numeric',
                ['attribute' => __('accounts::gpf.loan.amount'),
                    'min' => EnToBnNumberConverter::en2bn(1)]),
            'current_balance.lte' => __('validation.lte.numeric',
                ['attribute' => __('accounts::gpf.loan.current_balance'),
                    'value' => EnToBnNumberConverter::en2bn($this->current_balance)])

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
