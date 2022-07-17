<?php

namespace Modules\HM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateBookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'date_format:"j F, Y"|after_or_equal:today|required',
            'end_date' => 'date_format:"j F, Y"|after:start_date|required',
            'booking_type' => 'in:general,training,venue|required',
            'roomInfos' => 'required',
            'roomInfos.*.room_type_id' => 'exists:room_types,id|required',
            'roomInfos.*.quantity' => 'numeric|min:1|required',
            'first_name' => 'required|max:50',
            'middle_name' => 'nullable|max:50',
            'last_name' => 'required|max:50',
            'gender' => 'in:male,female|required',
            'contact' => 'required|numeric|digits:11',
            'address' => 'required|max:300',
            'email' => 'nullable|email',
            'nid' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!in_array(strlen($value), [10, 13, 17])) {
                        $fail(trans('labels.nid_validation_count_error_msg'));
                    }
                }
            ],
            'passport_no' => 'nullable|min:8|max:20',
            'passport_doc' => 'nullable|mimes:jpeg,bmp,png|max:3072',
            'organization' => 'nullable|max:50',
            'designation' => 'nullable|max:50',
            'organization_type' => 'required|in:government,non_government,international,bard,others',
            'org_address' => 'nullable|max:300',
            'photo' => 'mimes:jpeg,bmp,png|max:3072',
            'nid_doc' => 'nullable|mimes:jpeg,bmp,png|max:3072',
            'guests' => 'nullable',
            'guests.*.first_name' => 'max:50|required',
            'guests.*.last_name' => 'max:50|required',
            'guests.*.gender' => 'in:male,female|required',
            'guests.*.relation' => 'max:50|required',
            'guests.*.nid_doc' => 'nullable|mimes:jpeg,bmp,png|max:3072',
            'guests.*.nationality' => 'required|alpha',
            'guests.*.address' => 'max:300|required',
            'employee_id' => 'nullable|exists:employees,id',
            'organization_purpose' => 'required_if:organization_type,government',
            'guests.*.nid_no' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!in_array(strlen($value), [10, 13, 17])) {
                        $fail(trans('labels.nid_validation_count_error_msg'));
                    }
                }
            ],
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
