<?php

namespace Modules\RMS\Entities;

use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Entities\Organization\Organization;
use App\Entities\Task;
use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Publication\Entities\PublicationRequest;

class Research extends Model
{
    protected  $table = 'research';
    protected $fillable = ['title', 'submitted_by', 'status', 'research_detail_submission_id'];

    public function organizations()
    {
        return $this->morphToMany(Organization::class, 'organizable');
    }

    public function researchSubmittedByUser()
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
        return $this->hasMany(ResearchBudget::class, 'research_id');
    }

    public function publication()
    {
        return $this->hasOne(Publication::class);
    }

    public function publicationRequest()
    {
        return $this->hasOne(PublicationRequest::class);
    }

    public function proposal()
    {
        return $this->belongsTo(ResearchDetailSubmission::class, 'research_detail_submission_id', 'id');
    }
}
