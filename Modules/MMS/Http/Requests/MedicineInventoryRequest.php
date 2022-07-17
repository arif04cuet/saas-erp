<?php

namespace Modules\MMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MedicineInventoryRequest extends FormRequest
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
                'medicine_id' => 'required|integer',
                'quantity' => 'required|integer|max:10000',
            ];
        } else {
            return [
                'medicine_id' => 'required|integer',
                'quantity' => 'required|integer|max:10000',
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'medicine_id.required' => trans('mms::medicine_inventory.medicine_id_required'),
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
