<?php

namespace Modules\Cafeteria\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_bn' => 'required|string|min:3|max:50',
            'name_en' => 'required|string|min:3|max:50',
            'location' => 'required|string|min:3|max:50',
            'priority_level' => 'required|integer|min:1|max:10',
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
