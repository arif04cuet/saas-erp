<?php

namespace Modules\VMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VehicleFuelBillSubmitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'acknowledgement_one' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
                'acknowledgement_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
                'date' => 'required',
                'filling_station_id' => 'required',
                'amount' => 'required|max:7|regex:/^\d+(\.\d{1,2})?$/',
                'voucher_number' => 'nullable|max:20'
            ];
        } else {
            return [
                'acknowledgement_one' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
                'acknowledgement_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
                'date' => 'required',
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
            'amount.max' => trans('labels.At most 7 characters')
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
