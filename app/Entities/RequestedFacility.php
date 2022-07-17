<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class RequestedFacility extends Model
{
    protected $fillable = [
        'physical_facility_request_id',
        'facility_type',
        'reference_table_id',
        'book_from',
        'book_to'
    ];
}
