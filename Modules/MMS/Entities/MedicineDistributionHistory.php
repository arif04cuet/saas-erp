<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class MedicineDistributionHistory extends Model
{
    protected $fillable = ['distribution_id', 'medicine_id', 'quantity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }
}
