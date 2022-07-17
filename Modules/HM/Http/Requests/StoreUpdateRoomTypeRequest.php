<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRoomTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'bangla_name' => 'nullable',
            'capacity' => 'required|numeric|min:1|max:10',
            'government_official_rate' => 'required|numeric|min:1',
            'government_personal_rate' => 'required|numeric|min:1',
            'non_government_rate' => 'required|numeric|min:1',
            'international_rate' => 'required|numeric|min:1',
            'bard_rate' => 'required|numeric|min:1',
            'others_rate' => 'required|numeric|min:1',
        ];

        if ($this->method() == 'POST') {
            $rules['name'] = 'required|unique:room_types';
        } else {
            $rules['name'] = 'required|unique:room_types,name,' . $this->roomType->id;
        }

        return $rules;
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
