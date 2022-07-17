<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreUpdateAppraisalSettingRequest extends FormRequest
{
    const APPRAISAL_SETTING_LANG = 'hrm::appraisal_setting';

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = $this->getValidationRules();

        if ($request->isMethod('put')) {
            $rules['appraisal_setting_id'] = 'required|exists:appraisal_settings,id';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'reporter_id' => trans(self::APPRAISAL_SETTING_LANG . '.reporter'),
            'signer_id' => trans(self::APPRAISAL_SETTING_LANG . '.signer'),
            'commenter_id' => trans(self::APPRAISAL_SETTING_LANG . '.commenter'),
            'reviewees' => trans(self::APPRAISAL_SETTING_LANG . '.reviewees'),
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
     * @return array
     */
    private function getValidationRules(): array
    {
        $commonValidation = 'required|exists:employees,id';
        return [
            'reporter_id' => $commonValidation . '|different:signer_id|different:commenter_id',
            'signer_id' => $commonValidation . '|different:reporter_id|different:commenter_id',
            'commenter_id' => $commonValidation . '|different:reporter_id|different:signer_id',
            'reviewees' => [
                'required',
                'array',
                Rule::unique('appraisal_reviewees', 'employee_id')
                    ->where(function ($query) {
                        return $query->where('appraisal_setting_id', '!=', $this->request->get('appraisal_setting_id'))
                            ->whereIn('employee_id', $this->request->get('reviewees'));
                    }),
                function ($attribute, $value, $fail) {
                    if (in_array($this->request->get('reporter_id'), $value)
                        || in_array($this->request->get('signer_id'), $value)
                        || in_array($this->request->get('commenter_id'), $value)) {
                        $fail(trans(self::APPRAISAL_SETTING_LANG . '.reviewees_cannot_be_reviewers'));
                    }
                },
            ]
        ];
    }
}
