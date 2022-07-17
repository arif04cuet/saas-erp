<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RMS\Entities\Research;


class Task extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'amount',
        'amount_unit',
        'expected_start_time',
        'expected_end_time',
        'actual_start_time',
        'actual_end_time',
        'description',
        'taskable_id',
        'taskable_type',
    ];

    public function attachments()
    {
        return $this->hasMany(TaskAttachment::class, 'task_id', 'id');
    }

    public function researches()
    {
        return $this->belongsTo(Research::class, 'taskable_id','id');
    }
}
