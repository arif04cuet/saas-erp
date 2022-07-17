<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $fillable = ['name', 'start', 'end'];

    public function budget()
    {
        return $this->hasOne(AccountsBudget::class);
    }
}
