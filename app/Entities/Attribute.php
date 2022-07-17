<?php

namespace App\Entities;

use App\Entities\Organization\Organization;
use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\AttributePlanning;
use Modules\PMS\Entities\Project;

class Attribute extends Model
{
    protected $fillable = ['name', 'unit', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }

    public function plannings()
    {
        return $this->hasMany(AttributePlanning::class, 'attribute_id', 'id');
    }
}
