<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppraisalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'signer_comment_on_reporting_officer_evaluation' => 'required_if:status,reported',
            'signer_evaluation_value' => 'required_if:status,reported',
            'signer_officer_signature' => 'required_if:status,reported',
            'signer_officer_seal' => 'required_if:status,reported',
            'finisher_evaluation_remarks' => 'required_if:status,signed',
            'finisher_officer_signature' => 'required_if:status,signed',
            'officer_officer_seal' => 'required_if:status,signed',
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
