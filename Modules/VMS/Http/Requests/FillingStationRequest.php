<?php

namespace Modules\VMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FillingStationRequest extends FormRequest
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
                'name' => 'required|max:100|unique:vehicle_filling_stations,id,' . $id['id'],
                'address' => 'required|max:255',
                'contact_person_name' => 'nullable|max:60|min:1',
                'contact_person_mobile' => 'nullable|max:11|min:1'
            ];
        } else {
            return [
                'name' => 'required|max:100|unique:vehicle_filling_stations',
                'address' => 'required|max:255',
                'email' => 'nullable|email|max:100',
                'contact_person_name' => 'nullable|max:60|min:1',
                'contact_person_mobile' => 'nullable|max:11|min:1'
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = [
            'name.unique' => trans('vms::fillingStation.unique')
        ];

        return $messages;
    }

    public function authorize()
    {
        return true;
    }
}
