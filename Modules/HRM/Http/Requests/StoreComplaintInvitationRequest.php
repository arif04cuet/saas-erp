<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintInvitationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'complainer_id' => 'required|exists:employees,id|different:complainee_id|different:employee_id',
            'complainee_id' => 'required|exists:employees,id|different:complainer_id|different:employee_id',
            'employee_id' => 'required|exists:employees,id|different:complainer_id|different:complainee_id',
            'remark' => 'required|max:300',
            'reason' => 'required|max:300',
            'attachments' => 'nullable'
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
