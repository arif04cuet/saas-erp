<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class PensionConfiguration extends Model
{
    protected $fillable = [
        'title',
        'percentage',
        'lump_sum_number',
        'lump_sum_percentage',
        'monthly_pension_percentage',
        'minimum_pension_amount',
        'medical_allowance_increment_age',
        'initial_medical_allowance',
        'medical_allowance_after_increment',
        'status'
    ];

    const status = ['active', 'inactive'];

    public function rules()
    {
        return $this->hasMany(PensionRule::class);
    }
}
