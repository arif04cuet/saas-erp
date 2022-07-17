<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseApplicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'department' => 'required',
            'salary_grade' => 'required',
            'salary_scale' => 'required',
            'salary' => 'required',
            'birth_date' => 'required',
            'house_detail_id' => 'required',
            'bard_joining_date' => 'required',
            'present_address' => 'required|max:255'
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
