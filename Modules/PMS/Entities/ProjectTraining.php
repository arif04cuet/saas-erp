<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectTraining extends Model
{
    protected $fillable = ['title', 'project_id'];
    protected $table = 'project_training';

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id' );
    }

    /*public function members()
    {
        return $this->hasManyThrough(
            ProjectTraining::class,
            ProjectTrainingMember::class,
            'training_id',
            'id'
        );
    }*/

    public function members()
    {
        return $this->hasMany(ProjectTrainingMember::class, 'training_id', 'id');
    }
}
