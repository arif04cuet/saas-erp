<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUpdateTrainingCourseModuleSessionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'sessions.*.title' => 'required|max:500',
            'sessions.*.description' => 'nullable|max:500',
            'sessions.*.mark' => 'nullable|numeric|max:1000',
            'sessions.*.speaker_expire_timeline' => 'nullable|numeric|max:720|min:5',
            //'sessions.*.training_course_resource_id' => 'required',
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
