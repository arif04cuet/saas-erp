<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingCourseAdministrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coordinator' => [
                'required',
                'exists:employees,id',
                $this->customRuleDifferent()
            ],
            'director' => [
                'required',
                'exists:employees,id',
                $this->customRuleDifferent()
            ],
            'associate_director' => [
                'nullable',
                $this->customRuleDifferent()
            ],
            'assistant_director' => [
                'nullable',
                $this->customRuleDifferent()
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

    /**
     * @return \Closure
     */
    private function customRuleDifferent(): \Closure
    {
        return function ($attribute, $value, $fail) {
            $requestData = $this->request->all();
            unset($requestData[$attribute]);

            $otherKeyValues = array_filter($requestData, function ($value) {
                return intval($value) > 0;
            });

            foreach ($otherKeyValues as $otherKey => $otherValues) {
                if ($otherValues === $value) {
                    $fail(trans('validation.different', ['attribute' => $attribute, 'other' => $otherKey]));
                }
            }
        };
    }
}
