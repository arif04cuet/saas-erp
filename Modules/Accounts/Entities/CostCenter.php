<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $fillable = ['title', 'title_bangla', 'code', 'sequence'];

    public function economyCode()
    {
        return $this->hasOne(EconomyCode::class, 'code', 'code');
    }
}
