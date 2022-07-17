<?php

namespace Modules\MMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MedicineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return string[]
     */
    public function rules(Request $request)
    {

        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'name' => 'required|max:255|min:1|unique:medicines,name,' . $id['id'],
                'generic_name' => 'required|max:255|min:1',
                'group_name' => 'nullable|string||max:255|min:1|unique:medicine_groups,name',
                'company_name' => 'nullable|string||max:255|min:1'
            ];
        } else {
            return [
                'name' => 'required|max:255|min:1|unique:medicines',
                'generic_name' => 'required|max:255|min:1',
                'group_name' => 'nullable|string|max:255|min:1|unique:medicine_groups,name',
                'company_name' => 'nullable|string||max:255|min:1'
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = [
            'name.unique' => trans('mms::medicine.unique')
        ];

        return $messages;
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
