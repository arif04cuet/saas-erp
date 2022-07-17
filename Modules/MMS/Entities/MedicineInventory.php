<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class MedicineInventory extends Model
{
    protected $table = 'medicine_inventories';
    protected $fillable = ['medicine_id', 'quantity', 'previous_quantity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }

    /**
     * Get the medicine history for the medicine view.
     */
    public function history()
    {
        return $this->hasMany(MedicineInventoryHistory::class, 'medicine_id', 'id');

    }
}
