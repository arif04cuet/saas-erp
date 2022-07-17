<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\ProjectAttributePlannedValue;
use Modules\PMS\Entities\ProjectAttributeAchievedValue;

class ProjectAttribute extends Model
{
    protected $table = 'project_attributes';
    protected $fillable = [
        'project_id',
        'name',
        'unit',
    ];

    public function planned()
    {
        return $this->hasMany(ProjectAttributePlannedValue::class, 'project_attribute_id', 'id');
    }
    public function achieved()
    {
        return $this->hasMany(ProjectAttributeAchievedValue::class, 'project_attribute_id', 'id');
    }
}
