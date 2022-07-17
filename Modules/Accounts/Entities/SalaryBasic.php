<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryBasic extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];


    public function payscale()
    {
        return $this->belongsTo(Payscale::class, 'payscale_id', 'id')->withDefault();
    }
}
