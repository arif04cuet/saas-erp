<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['patient_id', 'date', 'name', 'age', 'mobile_no', 'gender', 'relation', 'type', 'employee_id', 'symptoms', 'comments', 'acknowledgement_slip', 'past_illness'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(PrescriptionMedicine::class, 'prescription_id', 'id');
    }

    /**
     * @return mixed
     */
    public function medicine()
    {
        return $this->hasOneThrough(
            PrescriptionMedicine::class,
            Medicine::class,
            'medicine_id', // Foreign key on cars table...
            'car_id', // Foreign key on owners table...
            'id', // Local key on mechanics table...
            'id' // Local key on cars table...
        );
    }
}
