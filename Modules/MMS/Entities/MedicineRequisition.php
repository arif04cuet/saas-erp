<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class MedicineRequisition extends Model
{
    protected $fillable = ['requisition_id', 'date', 'status', 'updated_by'];

    /**
     * Get the requisition details for the requisition details table.
     */

    public function details()
    {

        return $this->hasMany(MedicineRequisitionDetails::class, 'requisition_id', 'id');

    }
}
