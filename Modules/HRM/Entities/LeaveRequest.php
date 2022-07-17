<?php

namespace Modules\HRM\Entities;

use App\Entities\StateDetail;
use App\Entities\User;
use App\Traits\Workflowable;
use Carbon\Carbon;
use Iben\Statable\Models\StateHistory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use Workflowable;

    protected $fillable = [
        'leave_type_id',
        'requester_id',
        'start_date',
        'end_date',
        'duration',
        'reason',
        'status',
        'leave_type_purpose_id',
    ];

    /**
     * @return string[]
     */
    public static function getWorkflowRoleNames()
    {
        return [
            'ROLE_SECTION_OFFICER'
        ];
    }

    protected function getGraph()
    {
        return 'leave-request-workflow';
    }

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }

    public function purpose()
    {
        return $this->hasOne(LeaveTypePurpose::class, 'id', 'leave_type_purpose_id');
    }

    public function attachments()
    {
        return $this->hasMany(LeaveRequestAttachment::class, 'leave_request_id', 'id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'id');
    }

    public function stateDetails()
    {
        return $this->hasManyThrough(StateDetail::class, StateHistory::class, 'statable_id', 'state_history_id', 'id',
            'id')
            ->where('statable_type', LeaveRequest::class);
    }

    public function getDuration()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $days = $startDate->diffInDays($endDate) + 1;

        return "$days days";
    }
}
