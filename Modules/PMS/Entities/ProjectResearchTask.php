<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RMS\Entities\ResearchProposalSubmission;

class ProjectResearchTask extends Model
{
    use SoftDeletes;

    protected $table= 'project_research_tasks';
    protected $fillable = ['task_id', 'task_for_id', 'type', 'expected_start_time', 'expected_end_time', 'start_time', 'end_time', 'description'];

    public function attachments()
    {
        return $this->hasMany(TaskAttachments::class, 'project_research_task_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class, 'project_research_task_id', 'id' );
    }

    public function project()
    {
        return $this->belongsTo(ProjectProposal::class, 'task_for_id', 'id');
    }

    public function research()
    {
        return $this->belongsTo(ResearchProposalSubmission::class, 'task_for_id', 'id');
    }

    public function taskName()
    {
        return $this->hasOne(Task::class, 'id', 'task_id');
    }
}
