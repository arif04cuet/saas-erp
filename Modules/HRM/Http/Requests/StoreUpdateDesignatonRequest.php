<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUpdateDesignatonRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules( Request $request ) {
		return [
			'name' => 'required|max:50|unique:designations,name,' . $request->id . ',id,doptor_id,' . auth()->user()->doptor_id,
			'short_name' => 'nullable|max:10|unique:designations,short_name,' . $request->id . ',id,doptor_id,' . auth()->user()->doptor_id
		];
	}

	public function messages() {
		return [
			'name.required' => "Enter designation name",
			'name.unique'   => 'You already added this designation. enter new designation',
			'name.max'   => 'Designation name should not exceed 50 characters',
			'short_name.max'   => 'Designation short name should not exceed 10 characters',
			'short_name.unique'   => 'You already added this designation short name. enter new designation short name',
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
