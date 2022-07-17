<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyPensionContractRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required|unique:monthly_pension_contracts,employee_id,' . $this->employee_id .
                ',employee_id,nominee_id,' . $this->nominee_id,
            'ppo_number' => 'required|unique:monthly_pension_contracts,ppo_number,' . $this->id,
            'receiver' => 'required',
            'initial_basic' => 'required',
            'current_basic' => 'required',
            'increment' => 'required|numeric',
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
