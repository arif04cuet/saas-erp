<?php

namespace Modules\Cafeteria\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CafeteriaIncomeExpenseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'reference' => 'required',
            'cafeteria_journal_entries.*.account_transaction_type' => 'required',
            'cafeteria_journal_entries.*.economy_code' => 'required',
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
            'date' => trans('labels.This field is required'),
            'reference' => trans('labels.This field is required'),
            'journal_entries.*.account_transaction_type.required' => trans('labels.This field is required'),
            'journal_entries.*.economy.required' => trans('labels.This field is required'),
        ];
    }
}
