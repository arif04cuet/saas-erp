<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseCircularRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reference_no' => 'required|max:255',
            'apply_from' => 'required',
            'apply_to' => 'required',
            'house-entries.*.house_category_id' => 'required',
            'house-entries.*.house_details_id' => 'required',
            'house-entries.*.designation_id' => 'required'
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
