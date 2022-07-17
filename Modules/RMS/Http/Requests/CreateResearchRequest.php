<?php

namespace Modules\RMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateResearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'research_detail_submission_id' => 'required',
            'title' => 'required|max:100'
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
