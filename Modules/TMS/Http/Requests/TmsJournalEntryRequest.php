<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TmsJournalEntryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'training_id' => 'required',
            'fiscal_year_id' => 'required',
            'date' => 'required',
            'title' => 'required|max:50',
            'tms_journal_entries.*.remark' => 'max:50',
            'tms_journal_entries.*.transaction_type' => 'required',
            'tms_journal_entries.*.tms_sub_sector_id' => 'required',
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
            'training_id' => trans('labels.This field is required'),
            'fiscal_year_id' => trans('labels.This field is required'),
            'date' => trans('labels.This field is required'),
            'title' => trans('labels.This field is required'),
            'tms_journal_entries.*.remark.required' => trans('labels.This field is required'),
            'tms_journal_entries.*.transaction_type.required' => trans('labels.This field is required'),
            'tms_journal_entries.*.tms_sub_sector_id.required' => trans('labels.This field is required'),
        ];
    }


}
