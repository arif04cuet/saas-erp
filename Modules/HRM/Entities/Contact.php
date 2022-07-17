<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'organaization',
        'designation',
        'contact_type_id',
        'address',
        'mobile_one',
        'mobile_two',
        'email',
        'website'
    ];

    public function contactType()
    {
        return $this->belongsTo(ContactType::class, 'contact_type_id', 'id');
    }
}
