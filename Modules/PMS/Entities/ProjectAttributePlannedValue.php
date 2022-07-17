<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectAttributePlannedValue extends Model
{
    protected $table = 'project_attribute_planned_values';
    protected $fillable = [
        'project_attribute_id',
        'planned_value',
        'date',
    ];

    public function projectAttribute()
    {
        return $this->belongsTo(Attribute::class, 'project_attribute_id', 'id');
    }
}
