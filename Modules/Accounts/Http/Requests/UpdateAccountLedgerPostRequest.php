<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountLedgerPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_head_id' => 'required',
            'name' => 'required|max:255|unique:account_ledgers,name,' . $this->id,
            'code' => 'required|alpha_num|unique:account_ledgers,code,' . $this->id,
            'opening_balance_type' => 'required|max:2',
            'opening_balance' => 'numeric|min:0',
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
            'opening_balance.min'  => 'Opening balance can\'t be negative',
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
