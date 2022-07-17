<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHostelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:hostels',
            'bangla_name' => 'nullable',
            'total_floor' => 'required|numeric',
//            'total_room' => 'required|numeric|min:1',
//            'total_seat' => 'required|numeric|min:1',
//            'room_types' => 'required',
//            'room_types.*.name' => 'required|max:100',
//            'room_types.*.capacity' => 'required|numeric|min:1',
//            'room_types.*.rate' => 'required|numeric|min:1',
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
