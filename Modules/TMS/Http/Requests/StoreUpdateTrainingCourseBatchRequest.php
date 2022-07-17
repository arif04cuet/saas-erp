<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUpdateTrainingCourseBatchRequest extends FormRequest
{
    /**
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $maxTrainee = optional($request->training)->no_of_trainee;
        $minTrainee = 1;

        return [
            'title.old.*' => 'required|max:100',
            'start_date.old.*' => 'required',
            'end_date.old.*' => 'required',
            'no_of_trainees.old.*' => 'required|numeric|max:' . $maxTrainee . '|min:' . $minTrainee,
            'title.new.*' => 'nullable|max:100',
            'start_date.new.*' => 'nullable',
            'end_date.new.*' => 'nullable',
            'no_of_trainees.new.*' => 'nullable|max:' . $maxTrainee . '|min:' . $minTrainee,
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
