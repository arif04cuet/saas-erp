<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\HM\Services\CheckinService;

class StoreCheckinPaymentRequest extends FormRequest
{
    /**
     * @var CheckinService
     */
    private $checkinService;

    /**
     * StoreCheckinPaymentRequest constructor.
     * @param CheckinService $checkinService
     */
    public function __construct(CheckinService $checkinService)
    {
        $this->checkinService = $checkinService;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shortcode' => 'nullable|size:11|unique:checkin_payments',
            'amount' => ['required','numeric','max:99999999','min:1',  function ($attribute, $value, $fail) {
                if ($value > $this->checkinService->getDueAmount($this->roomBooking)) {
                    $fail($attribute.' cannot be greater than total.');
                }
            }],
            'type' => 'required|in:cash,card,check',
            'check_number' => 'nullable|min:11',
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
