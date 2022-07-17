<?php

namespace Modules\VMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VehicleMaintenanceRequisitionRequest extends FormRequest
{
    /**
     * @param Request $request
     * @return string[]
     */
    public function rules(Request $request)
    {

        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'requisition' => 'required|unique:vehicle_maintenance_requisitions',
                'date' => 'required',
                'vehicle_id' => 'required',
                'driver_id' => 'required',
                'medicine.*' => 'required|min:1'
            ];
        } else {
            return [
                'requisition' => 'required|unique:vehicle_maintenance_requisitions',
                'date' => 'required|date',
                'vehicle_id' => 'required',
                'driver_id' => 'required',
                'medicine.*' => 'required|min:1'
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = [
            'requisition.unique' => trans('vms::maintenanceItem.items.unique')
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
