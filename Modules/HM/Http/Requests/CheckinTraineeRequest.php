<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckinTraineeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'trainee_id' => 'required',
            'assign' => 'required',
            'assign.*.room_type_id' => 'exists:room_types,id|required',
            'assign.*.room.*.room_show' => 'required',
            'assign.*.room.*.name' => 'nullable|max:50',
            'assign.*.room.*.mobile_number' => 'nullable|digits:11',
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
