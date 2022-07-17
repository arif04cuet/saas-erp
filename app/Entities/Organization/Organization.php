<?php

namespace App\Entities\Organization;

use App\Entities\AttributeValue;
use App\Entities\District;
use App\Entities\Division;
use App\Entities\Thana;
use App\Entities\Union;
use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\Project;
use Modules\RMS\Entities\Research;

class Organization extends Model
{
    protected $table = 'organizations';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'division_id',
        'district_id',
        'thana_id',
        'union_id',
    ];

    public function members()
    {
        return $this->hasMany(OrganizationMember::class, 'organization_id', 'id');
    }

    public function researches()
    {
        return $this->morphedByMany(Research::class, 'organizable');
    }

    public function projects()
    {
        return $this->morphedByMany(Project::class, 'organizable');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }

    public function attributeValues()
    {
        return $this->hasManyThrough(AttributeValue::class, OrganizationMember::class);
    }
}
