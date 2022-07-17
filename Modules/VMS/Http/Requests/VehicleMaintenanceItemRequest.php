<?php

namespace Modules\VMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VehicleMaintenanceItemRequest extends FormRequest
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
                'item_name_en' => 'required|max:255|min:1|unique:vehicle_maintenance_items,id,' . $id['id'],
                'item_name_bn' => 'nullable|max:255|min:1',
                'item_short_name' => 'nullable|max:255|min:1'
            ];
        } else {
            return [
                'item_name_en' => 'required|max:255|min:1|unique:vehicle_maintenance_items',
                'item_name_bn' => 'nullable|max:255|min:1',
                'item_short_name' => 'nullable|max:255|min:1'
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = [
            'item_name_en.unique' => trans('vms::maintenanceItem.items.unique')
        ];

        return $messages;
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
