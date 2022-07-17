<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TmsCodeSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code_settings.*.economy_code' => 'required',
            'code_settings.*.journal_id' => 'required',
            'code_settings.*.tms_sub_sector_id' => 'required',
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

    public function messages()
    {
        return [
            'code_settings.*.economy_code' => trans('labels.This field is required'),
            'code_settings.*.journal_id' => trans('labels.This field is required'),
            'code_settings.*.tms_sub_sector_id' => trans('labels.This field is required'),
        ];
    }
}
