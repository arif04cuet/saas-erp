<?php

namespace Modules\IMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequestWorkflowRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->transition == 'approve' && $this->requested_fixed_asset) {
            $rule = 'required|array|min:' . $this->requested_fixed_asset;
        } else {
            $rule = "";
        }
        return [
            'recipients.*' => 'required_if:transition,share',
            'remark' => 'required',
            'inventory_item_ids' => $rule
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
