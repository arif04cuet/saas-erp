<?php

namespace Modules\IMS\Http\Requests;

use App\Constants\DepartmentShortName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\IMS\Constants\InventoryRequestType;

/**
 * @property mixed give_detail
 */
class InitialInventoryRequestPutRequest extends FormRequest
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
        ];
    }

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
