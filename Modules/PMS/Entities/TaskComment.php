<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $table = 'task_comments';
    protected $fillable = ['project_research_task_id', 'comment', 'comment_by'];


    public function projectResearchTask()
    {
        return $this->belongsTo(ProjectResearchTask::class);
    }
}
