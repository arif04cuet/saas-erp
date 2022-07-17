<?php

namespace Modules\TMS\Entities;

use Modules\TMS\Entities\Training;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\TMS\Entities\TrainingCourseMarkAllotmentType;

class TrainingCostSegmentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost_type_id',
        'cost_detail',
        'unit_number',
        'unit_price',
        'vat',
        'tax',
        'total_amount',
        'total_cost'
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

    public function type()
    {
        return $this->belongsTo(TrainingCourseMarkAllotmentType::class, 'cost_type_id', 'id');
    }
    
}
