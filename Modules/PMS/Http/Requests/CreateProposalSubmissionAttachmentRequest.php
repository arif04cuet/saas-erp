<?php

namespace Modules\PMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProposalSubmissionAttachmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attachments' => 'required',
            'attachments.*' => 'required|mimes:doc,pdf,docx,csv,xlsx,xls|max:3072'
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
            'attachments.required' => __('pms::reviewer-add-attachments.validations.required'),
            'attachments.*.required' => __('pms::reviewer-add-attachments.validations.required'),
            'attachments.*.mimes' => __('pms::reviewer-add-attachments.validations.mimes') . '(:values)',
            'attachments.*.max' => __('pms::reviewer-add-attachments.validations.max', ['value'=>':max'])
        ];
    }

}
