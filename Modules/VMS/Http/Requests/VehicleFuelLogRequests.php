<?php


namespace Modules\VMS\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VehicleFuelLogRequests  extends FormRequest
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
                'date' => 'required',
                'vehicle_id' => 'required',
                'vehicle_type_id' => 'required',
                'fuel_type' => 'required',
                'fuel_quantity' => 'required|max:7|min:1',
                'filling_station_id' => 'required',
                'amount' => 'required|max:7|regex:/^\d+(\.\d{1,2})?$/',
                'voucher_number' => 'nullable|max:20'
            ];
        } else {
            return [
                'date' => 'required',
                'vehicle_id' => 'required',
                'vehicle_type_id' => 'required',
                'fuel_type' => 'required',
                'fuel_quantity' => 'required|max:7|min:1',
                'filling_station_id' => 'required',
                'amount' => 'required|max:7|regex:/^\d+(\.\d{1,2})?$/',
                'voucher_number' => 'nullable|max:20'
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = [
            'fuel_quantity.max' => trans('labels.At most 7 characters'),
            'fuel_quantity.min' => trans('At least 1 characters'),
            'amount.max' => trans('labels.At most 7 characters')
        ];

        return $messages;
    }

    public function authorize()
    {
        return true;
    }
}
