<?php

namespace Modules\IMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcurementAndBillSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'vat_economy_code' => 'required|exists:economy_codes,code',
            'it_economy_code' => 'required|exists:economy_codes,code',
            'items_economy_code' => 'required|exists:economy_codes,code',
            'journal_id' => 'required|exists:journals,id',
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
