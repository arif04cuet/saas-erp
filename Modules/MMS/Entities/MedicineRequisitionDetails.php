<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class MedicineRequisitionDetails extends Model
{
    protected $fillable = ['requisition_id', 'medicine_id', 'quantity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }
}
