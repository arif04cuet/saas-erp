<?php

namespace Modules\PMS\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TaskRequest extends FormRequest
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
            'name' => 'required',
            'expected_start_time' => 'required|date|date_format:Y-m-d',
            'expected_end_time' => 'required|date|date_format:Y-m-d|after_or_equal:expected_start_time',
            'actual_start_time' => 'nullable|date|date_format:Y-m-d|before_or_equal:' . Carbon::now()->format('Y-m-d'),
            'description' => 'required'
        ];

        if ($request->input('actual_end_time')) {
            $rules['actual_start_time'] = str_replace('nullable', 'required', $rules['actual_start_time']);
            $rules['actual_end_time'] = 'date|date_format:Y-m-d|after_or_equal:actual_start_time';
        }

        return $rules;
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
