<?php

namespace Modules\HRM\Entities;

use App\Entities\StateDetail;
use App\Entities\StateRecipient;
use Iben\Statable\Models\StateHistory;
use Iben\Statable\Statable;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use Statable;

    protected $table = 'appraisals';
    protected $fillable = [
        'reporting_employee_id',
        'start_date',
        'end_date',
        'initiator_id',
        'reporter_id',
        'medical_reporter_id',
        'signer_id',
        'finisher_id',
        'status',
        'type',
    ];

    protected $dates = ['start_date', 'end_data'];

    protected function getGraph()
    {
        return 'appraisal';
    }

    public function initiator()
    {
        return $this->belongsTo(Employee::class, 'initiator_id', 'id');
    }

    public function reportingEmployee()
    {
        return $this->belongsTo(Employee::class, 'reporting_employee_id', 'id');
    }

    public function reporter()
    {
        return $this->belongsTo(Employee::class, 'reporter_id', 'id');
    }

    public function medicalReporter()
    {
        return $this->belongsTo(Employee::class, 'medical_reporter_id', 'id');
    }

    public function signer()
    {
        return $this->belongsTo(Employee::class, 'signer_id', 'id');
    }

    public function finisher()
    {
        return $this->belongsTo(Employee::class, 'finisher_id', 'id');
    }

    public function metadata()
    {
        return $this->hasMany(AppraisalMetadata::class, 'appraisal_id', 'id');
    }

    public function content()
    {
        return $this->hasMany(AppraisalContent::class, 'appraisal_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(AppraisalDetail::class, 'appraisal_id', 'id');
    }

    public function stateDetails()
    {
        return $this->hasManyThrough(StateDetail::class, StateHistory::class, 'statable_id', 'state_history_id', 'id', 'id')
            ->where('statable_type', Appraisal::class);
    }

    public function stateRecipients()
    {
        return $this->hasManyThrough(StateRecipient::class, StateHistory::class, 'statable_id', 'state_history_id', 'id', 'id')
            ->where('statable_type', Appraisal::class);
    }
}
