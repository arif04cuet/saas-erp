<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\TrainingCostSegmentation;

class TrainingCourseMarkAllotmentType extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function trainingCostSegmentation()
    {
        return $this->belongsTo(TrainingCostSegmentation::class, 'cost_type_id', 'id');
    }
}
