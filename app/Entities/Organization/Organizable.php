<?php

namespace App\Entities\Organization;

use Illuminate\Database\Eloquent\Model;

class Organizable extends Model
{
    protected $table = 'organizables';
    protected $fillable = [
        'organization_id',
        'organizable_id',
        'organization_type',
    ];


    public function organizations()
    {
        return $this->morphToMany(Organization::class, 'organizable');
    }
}
