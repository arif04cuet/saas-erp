<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PrescriptionTest extends Model
{
    protected $fillable = ['prescription_id', 'test_name'];
}
