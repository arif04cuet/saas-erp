<?php

namespace Modules\RMS\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PublicationReviewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $validation = [];

        if ($request->status == 'SHARE') {
            $validation['employee_id'] = 'required';
        }
        $validation['message'] = 'max:255';
        $validation['remarks'] = 'required|max:255';
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
