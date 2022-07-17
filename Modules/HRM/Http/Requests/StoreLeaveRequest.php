<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Services\LeaveTypeService;

class StoreLeaveRequest extends FormRequest
{
    /**
     * @var LeaveTypeService
     */
    private $leaveTypeService;

    /**
     * StoreLeaveRequest constructor.
     * @param LeaveTypeService $leaveTypeService
     */
    public function __construct(LeaveTypeService $leaveTypeService)
    {
        $this->leaveTypeService = $leaveTypeService;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date_format:d/m/Y|before_or_equal:' . Carbon::now(),
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
