<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class MedicineDistribution extends Model
{
    protected $fillable = ['patient_id', 'prescription_id', 'date', 'status', 'acknowledgement_slip'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPrescribedDate()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id', 'id');
    }

    /**
     * Get the medicine history for the medicine view.
     */

    public function history()
    {
        return $this->hasMany(MedicineDistributionHistory::class, 'distribution_id', 'id');

    }


}
