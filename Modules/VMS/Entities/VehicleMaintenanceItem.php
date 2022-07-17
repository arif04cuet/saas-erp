<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleMaintenanceItem extends Model
{
    protected $fillable = ['item_name_en','item_name_bn','short_name','is_active'];
}
