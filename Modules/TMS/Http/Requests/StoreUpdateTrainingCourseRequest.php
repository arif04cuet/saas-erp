<?php

namespace Modules\TMS\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TrainingsService;

class StoreUpdateTrainingCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $validDateFormat = 'd/m/Y';
        // $trainingStartDate = Carbon::parse($this->training->start_date)->format($validDateFormat);
        // $trainingEndDate = Carbon::parse($this->training->end_date)->format($validDateFormat);
        // $dateBetweenTrainingDuration = "after_or_equal:$trainingStartDate|before_or_equal:$trainingEndDate";

        return [
            'training_id' => 'exists:trainings,id',
            // 'uid' => 'max:100|regex:/^TMS\-TR\-CR\-[0-9]+$/s',
            'name' => 'required|max:50',
            'name_bn' => 'required|max:50',
            'start_date' => "required",
            'end_date' => "required",
            'venue_id' => 'required|exists:training_venues,id'
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
