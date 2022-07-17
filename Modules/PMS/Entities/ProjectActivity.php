<?php

namespace Modules\PMS\Entities;

use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Entities\Task;
use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    protected $fillable = ['project_id', 'name', 'actual_start_date', 'actual_end_date'];


    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable', 'taskable_type', 'taskable_id', 'id');
    }

    public function monthlyUpdates()
    {
        return $this->morphMany(MonthlyUpdate::class, 'monthly_updatable');
    }
}
