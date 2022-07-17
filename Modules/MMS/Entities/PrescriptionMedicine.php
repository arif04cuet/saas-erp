<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicine extends Model
{
    protected $fillable = ['prescription_id', 'medicine_id', 'dose', 'in_stock', 'total_medicine', 'type', 'medicine_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }
}
