<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PensionConfigurationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'percentage' => 'required|numeric|max:999',
            'lump_sum_number' => 'required|numeric|max:1000',
            'lump_sum_percentage' => 'required|numeric|max:999',
            'monthly_pension_percentage' => 'required|numeric|max:999',
            'minimum_pension_amount' => 'required|numeric|max:99999',
            'medical_allowance_increment_age' => 'required|numeric|max:100',
            'initial_medical_allowance' => 'required|numeric|max:10000',
            'medical_allowance_after_increment' => 'required|numeric|max:100000',
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
