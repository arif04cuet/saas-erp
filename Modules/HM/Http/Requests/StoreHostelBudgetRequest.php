<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreHostelBudgetRequest extends FormRequest
{
    protected $errorBag = "hostelBudget";
    public function rules(Request $request)
    {
        return [
            'hostel_budget_title_id'       => 'required',
            'hostel_budgets.*.hostel_budget_section_id'       => 'required',
            'hostel_budgets.*.budget_amount'       => 'required',
        ];
    }

//    public function messages() {
//        $messages = [
//            'hostel_budget_title_id.required' => 'Please select budget title',
//            'hostel_budgets.*.hostel_budget_section_id.required' => 'Please select budget section ',
//            'hostel_budgets.*.budget_amount.required' => 'Please enter budget amount',
//        ];
//
//        return $messages;
//    }
    public function authorize()
    {
        return true;
    }
}
