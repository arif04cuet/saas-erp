<?php

namespace Modules\HRM\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppraisalInvitationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $signerEndDate = Carbon::parse($this->date)->addDays(7)->toDateString();
        $commenterEndDate = Carbon::parse($this->deadline_to_signer)->addDays(7)->toDateString();
        $commenterSignEndDate = Carbon::parse($this->deadline_to_final_commenter)->addDays(7)->toDateString();
        return [
            'title' => 'required|min:10|max:100',
            'appraisal_setting_id' => 'required',
            'deadline_to_signer' => 'required|after:'.$signerEndDate,
            'deadline_to_final_commenter' => 'required|after:'.$commenterEndDate,
            'deadline_final_commenter_sign' => 'required|after:'.$commenterSignEndDate
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
