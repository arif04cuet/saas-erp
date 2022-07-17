<?php


namespace Modules\MMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MedicineRequisitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return string[]
     */

    public function rules(Request $request)
    {

        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'requisition_id' => 'required|string',
                'date' => 'required|date',
            ];
        } else {
            return [
                'requisition_id' => 'required|string',
                'date' => 'required|date',
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'medicine_id.unique' => trans('mms::medicine_inventory.unique'),
            'quantity.required' => trans('labels.This field is required')
        ];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
