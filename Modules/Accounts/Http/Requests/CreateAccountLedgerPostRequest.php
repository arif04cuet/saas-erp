<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountLedgerPostRequest extends FormRequest
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
            'name' => 'required|max:255',
            'code' => 'required|alpha_num|unique:account_ledgers,code',
            'opening_balance_type' => 'required|max:2',
            'opening_balance' => 'numeric|min:0',
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
