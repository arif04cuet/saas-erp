<?php

namespace Modules\RMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostResearchBriefFeedbackRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $validation = [];

        if ($request->status == 'REVIEW') {
            $validation['designation_id'] = 'required';
        }
        $validation['remarks'] = 'required|max:255';
        $validation['message'] = 'max:255';

        return $validation;

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
