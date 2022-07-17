<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppraisalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'date_format:"j F, Y"|required_if:type,second|required_if:type,third|required_if:type,fourth',
            'end_date' => 'date_format:"j F, Y"|required_if:type,second|required_if:type,third|required_if:type,fourth',
            'content.*.value'=> 'required_if:type,second|required_if:type,third|required_if:type,fourth',
            'signer_id' => 'required_if:type,second|required_if:type,third|required_if:type,fourth',
            'medical_reporter_id' => 'required_if:type,first',
            'reporting_employee_id' => 'required_if:type,first',
            'reporter_officer_signature' => 'required_if:type,second|required_if:type,third|required_if:type,fourth',
            'reporting_officer_signature' => 'required_if:type,first',
            'reporter_officer_seal' => 'required_if:type,second|required_if:type,third|required_if:type,fourth',
            'reporting_officer_seal' => 'required_if:type,first',
            'reporter_officer_general_idea' => 'required_if:type,second|required_if:type,third',
            'reporter_officer_eligibility_for_promotion' => 'required_if:type,second|required_if:type,third',
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
