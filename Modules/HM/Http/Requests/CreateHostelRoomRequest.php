<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHostelRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hostel_id' => 'required|exists:hostels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'floor' => 'required|numeric|min:1',
            'room_numbers' => 'required|max:4',
//            'inventories' => 'required',
//            'inventories.*.item_name' => 'required',
//            'inventories.*.quantity' => 'required|numeric|min:1'
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
