<?php

namespace Modules\PMS\Entities;

use App\Entities\Attribute;
use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Entities\Organization\Organization;
use App\Entities\Task;
use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\VMS\Entities\TripBillPayment;

/**
 * @property mixed title
 * @property mixed submitted_by
 * @property mixed status
 */
class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'title',
        'duration',
        'budget',
        'fund_source',
        'submitted_by',
        'status',
        'project_detail_proposal_id',
        'purpose'
    ];

    public function organizations()
    {
        return $this->morphToMany(Organization::class, 'organizable');
    }

    public function projectSubmittedByUser()
    {
        return $this->belongsTo(User::class, 'submitted_by', 'id');
    }

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable', 'taskable_type', 'taskable_id', 'id');
    }

    public function monthlyUpdates()
    {
        return $this->morphMany(MonthlyUpdate::class, 'monthly_updatable');
    }

    public function budgets()
    {
        return $this->morphMany(DraftProposalBudget::class, 'budgetable', 'budgetable_type', 'budgetable_id', 'id');
    }

    public function budgetCreate()
    {
        return $this->hasMany(ProjectBudgets::class, 'project_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'project_id');
    }

    public function projectAttributes()
    {
        return $this->hasMany(ProjectAttribute::class, 'project_id');
    }

    public function projectTrainings()
    {
        return $this->hasMany(ProjectTraining::class);
    }

    public function proposal()
    {
        return $this->belongsTo(ProjectDetailProposal::class, 'project_detail_proposal_id', 'id');
    }

    public function tripBillPayment()
    {
        return $this->hasOne(TripBillPayment::class, 'project_id', 'id');
    }

    public function projectAssignedRole()
    {
        return $this->hasOne(ProjectAssignedRole::class, 'project_id', 'id');
    }

    public function projectActivities()
    {
        return $this->hasMany(ProjectActivity::class, 'project_id', 'id');
    }
}
