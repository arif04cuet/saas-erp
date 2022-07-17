<?php

namespace Modules\PMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectBudgetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'economy_code_id' => 'required',
            'section_type' => 'required',
//            'unit' => 'required',
//            'unit_rate' => 'required',
//            'quantity' => 'required',
            'total_expense' => 'required',
//            'total_expense_percentage' => 'required',
            'gov_source' => 'required',
            'own_financing_source' => 'required',
            'other_source' => 'required',
//            'fiscal_year.*' => '',
//            'monetary_amount.*' => '',
//            'monetary_percentage.*' => '',
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
