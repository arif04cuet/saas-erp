<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeLeaveWorkflowCreateUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recipients.*' => 'required_if:transition,share',
            // 'remark' => 'required'
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
            'recipients.*.required_if' => __('ims::inventory.recipients.error_message'),
            'remark.required' => __('ims::inventory.remark.error_message')
        ];
    }
}
