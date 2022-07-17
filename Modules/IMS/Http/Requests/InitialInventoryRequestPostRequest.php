<?php

namespace Modules\IMS\Http\Requests;

use App\Constants\DepartmentShortName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\IMS\Constants\InventoryRequestType;

/**
 * @property mixed give_detail
 */
class InitialInventoryRequestPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100|unique:inventory_requests',
            'from_location_id' => (get_user_department()->department_code == DepartmentShortName::InventoryDivision)
                ? ''
                : 'required',
            'to_location_id' => 'required',
            'type' => 'required|in:requisition,transfer,scrap,abandon',
            'receiver_id' => $this->type === InventoryRequestType::REQUISITION ? 'required' : '',
        ];
    }

    /*public function messages()
    {
        return [
            'title.unique' => 'The :attribute field is required',
        ];
    }*/

    public function messages()
    {
        return [
            'title.unique' => trans('validation.unique',['attribute' => trans('ims::inventory.inventory_request_title')]),
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
