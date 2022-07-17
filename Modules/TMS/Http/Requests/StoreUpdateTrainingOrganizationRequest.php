<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTrainingOrganizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unique_id' => 'required',
            'name' => 'required|min:3|max:100',
            'bangla_name' => 'required|min:3|max:100',
            'type' => 'required',
            'address' => 'nullable',
            'contact_person' => 'required|min:3|max:100',
            'contact_person_email' => 'required|email',
            'contact_person_cc' => 'nullable|email',
            'contact_person_phone' => 'nullable|numeric',
            'note' => 'nullable',
            ''
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
