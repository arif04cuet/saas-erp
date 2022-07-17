<?php

namespace Modules\IMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInventoryItemCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:inventory_item_categories,name,' . $this->id,
            'type' => 'required',
            'unit' => 'required',
            'short_code' => 'required|max:6|unique:inventory_item_categories,short_code,' . $this->id
        ];
    }



    public function messages()
    {
        return [
            'name.unique' => trans('validation.unique',['attribute' => trans('labels.name')]),
            'short_code.unique' => trans('validation.unique',['attribute' => trans('ims::inventory.short_code')]),
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
