<?php

namespace Modules\HRM\Entities;

use App\Entities\StateDetail;
use App\Entities\StateRecipient;
use Iben\Statable\Models\StateHistory;
use Iben\Statable\Statable;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use Statable;

    protected $fillable = ['complainer_id', 'complainee_id', 'reason', 'status', 'complaint_invitation_id'];

    protected function getGraph()
    {
        return 'complaint';
    }

    public function attachments()
    {
        return $this->morphMany(ComplaintAttachment::class, 'complaint_attachmentable');
    }

    public function complainer()
    {
        return $this->belongsTo(Employee::class, 'complainer_id', 'id');
    }

    public function complainee()
    {
        return $this->belongsTo(Employee::class, 'complainee_id', 'id');
    }

    public function invitation()
    {
        return $this->belongsTo(ComplaintInvitation::class, 'complaint_invitation_id', 'id');
    }

    public function stateDetails()
    {
        return $this->hasManyThrough(StateDetail::class, StateHistory::class, 'statable_id', 'state_history_id', 'id', 'id')
            ->where('statable_type', Complaint::class);
    }

    public function stateRecipients()
    {
        return $this->hasManyThrough(StateRecipient::class, StateHistory::class, 'statable_id', 'state_history_id', 'id', 'id')
            ->where('statable_type', Complaint::class);
    }
}
