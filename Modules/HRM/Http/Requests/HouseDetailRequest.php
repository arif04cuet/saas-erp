<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'house_id' => 'required|unique:house_details,house_id,' . $id['house_detail'],
                'house_type' => 'required',
                'location' => 'required|max:255',
                'status' => 'required',
            ];
        } else {
            return [
                'house_id' => 'required|unique:house_details,house_id',
                'house_type' => 'required',
                'location' => 'required|max:255',
                'status' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'house_id.unique' => trans('hrm::house-details.house_id_msg'),
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
