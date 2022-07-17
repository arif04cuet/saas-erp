<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreDepartmentRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules( Request $request ) {

		return [
			'name' => 'required|max:50|unique:departments,name,' . $request->id . ',id,doptor_id,' . auth()->user()->doptor_id,
			'department_code' => 'nullable|max:10|unique:departments,department_code,' . $request->id . ',id,doptor_id,' . auth()->user()->doptor_id

		];
	}

	public function messages() {
		return [
			'name.required' => "Enter department name",
			'name.unique' => 'You already added this name. enter new name',
			'name.max' => trans('validation.maxlength', ['attribute' => __('labels.name'), 'max' => 50]),
			'department_code.max' => trans('validation.maxlength', ['attribute' => __('hrm::department.department_code'), 'max' => 10])
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}
}
