<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class PensionDeduction extends Model
{
    protected $fillable = ["name", "bangla_name", "pension_deduction_type", "economy_code", "description"];

    const PENSION_DEDUCTION_TYPE = ['lump_sum', 'prl'];

    public function lumpSUmDeduction()
    {
        return $this->hasOne(LumpSumDeduction::class, 'pension_deduction_id', 'id');
    }

}
