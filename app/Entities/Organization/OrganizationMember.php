<?php

namespace App\Entities\Organization;

use App\Entities\AttributeValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    protected $table = 'organization_members';
    protected $fillable = [
        'organization_id',
        'name',
        'mobile',
        'address',
        'gender',
        'nid',
        'dob',
        'is_active',
        'short_code'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'organization_member_id', 'id');
    }

    public function getAge()
    {
        return Carbon::parse($this->dob)->diffInYears(Carbon::today());
    }
}
