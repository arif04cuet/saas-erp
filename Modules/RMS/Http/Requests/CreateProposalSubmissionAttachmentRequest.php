<?php

namespace Modules\RMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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
            'attachments.required' => __('rms::reviewer-add-attachments.validations.required'),
            'attachments.*.required' => __('rms::reviewer-add-attachments.validations.required'),
            'attachments.*.mimes' => __('rms::reviewer-add-attachments.validations.mimes') . '(:values)',
            'attachments.*.max' => __('rms::reviewer-add-attachments.validations.max', ['value'=>':max'])
        ];
    }
}
