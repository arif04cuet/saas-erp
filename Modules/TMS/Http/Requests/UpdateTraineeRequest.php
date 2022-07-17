<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTraineeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $trainee = $request->trainee;

        return [
            'mobile' => [
                'required',
                'string',
                'size:11',
                Rule::unique('trainees', 'mobile')
                    ->where('training_id', $this->training_id)
                    ->whereNull('deleted_at')
                    ->ignore($trainee->id, 'id')
            ]
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
