<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectAttributeAchievedValue extends Model
{
    protected $table = 'project_attribute_achieved_values';
    protected $fillable = [
        'project_attribute_id',
        'achieved_value',
        'date',
    ];

    public function projectAttribute()
    {
        return $this->belongsTo(Attribute::class, 'project_attribute_id', 'id');
    }
}
