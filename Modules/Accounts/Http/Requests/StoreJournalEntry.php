<?php
namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreJournalEntry extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function rules(Request $request)
    {
        //dd($request->all());
        $generalData = [
            'date'       => 'required',
            'reference'  => 'max:255',
            'journal_id' => 'max:255',
            'dept_id'    => 'max:255',
        ];
        $repeaterValidation = [];
        foreach ($request->journal_entries as $key => $journalEntry) {
            if ($journalEntry['debit_max']) {
                $repeaterValidation['journal_entries.'.$key.'.debit_amount'] = 'numeric|max:'.$journalEntry['debit_max'];
            }
        }
        $validation = array_merge($generalData, $repeaterValidation);
        return $validation;
    }

    public function messages()
    {
        $repeaterValidationMessages = [];
        foreach ($this->journal_entries as $key => $journalEntry) {
            if ($journalEntry['debit_max']) {
                $repeaterValidationMessages['journal_entries.'.$key.'.debit_amount'] = [
                    'lte' => __('validation.max.numeric', [
                        'attribute' => $journalEntry['economy_code'],
                        'max'       => $journalEntry['debit_max']
                    ])
                ];

            }
        }
        return $repeaterValidationMessages;
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
