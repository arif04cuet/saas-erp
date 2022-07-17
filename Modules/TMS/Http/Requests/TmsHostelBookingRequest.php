<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TmsHostelBookingRequest extends FormRequest
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
            'start_date' => 'date_format:"Y-m-d"|after_or_equal:today|required',
            'end_date' => 'date_format:"Y-m-d"|after_or_equal:start_date|required',
            'tms_hostel_booking_request.*.room_type_id' => 'required',
            'tms_hostel_booking_request.*.quantity' => 'required',
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
            'training_id.required' => trans('labels.This field is required'),
            'start_date.required' => trans('labels.start_date_greater_than_or_equal_end_date'),
            'end_date.after_or_equal' => trans('labels.end_date_greater_than_or_equal_start_date'),
            'tms_hostel_booking_request.*.room_type_id.required' => trans('labels.This field is required'),
            'tms_hostel_booking_request.*.quantity.required' => trans('labels.This field is required'),
        ];
    }


}
