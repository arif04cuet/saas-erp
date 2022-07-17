<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleMaintenanceRequisitionDetails extends Model
{
    protected $fillable = ['requisition_id','item_id','quantity','price'];

    public function requisiteItem()
    {
        return $this->belongsTo(VehicleMaintenanceItem::class, 'item_id', 'id');
    }
}
