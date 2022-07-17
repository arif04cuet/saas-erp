<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class ProjectAssignedRole extends Model
{
    protected $fillable = [
        'project_id',
        'project_director_id',
        'project_sub_director_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')
            ->withDefault();
    }

    public function projectDirector()
    {
        return $this->belongsTo(Employee::class, 'project_director_id', 'id')
            ->withDefault();
    }

    public function projectSubDirector()
    {
        return $this->belongsTo(Employee::class, 'project_sub_director_id', 'id')
            ->withDefault();
    }
}
