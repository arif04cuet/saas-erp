<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PrescriptionsEo extends Model
{
    protected $fillable = ['prescription_id', 'oe_name', 'oe_value'];
}
