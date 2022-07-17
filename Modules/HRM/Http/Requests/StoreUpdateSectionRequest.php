<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class StoreUpdateSectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'name' => [
                'required',
                'max:50',
                Rule::unique('sections')->where(function ($query) use($request){
                    return $query->where('department_id', $request->department_id )
                        ->where('deleted_at', null);
                })->ignore($request->section_id)
            ],
            'department_id' => 'required',
            'section_code' => [
                'nullable',
                'max:10',
                Rule::unique('sections')->where(function ($query) use ($request) {
                    return $query->where('id', '!=', $request->section_id)
                        ->whereNull('deleted_at');
                })
            ]
        ];

        return $rules;
    }

    public function messages() {
        return [
            'section_code.max' => "Section code must be in 10 characters",
            'section_code.unique' => 'Section code already exist. Try another',
            'department_id' => trans('validation.required', ['attribute' => __('hrm::department.department')]),
            'name.unique' => trans('validation.unique', ['attribute' => __('labels.name')])

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
