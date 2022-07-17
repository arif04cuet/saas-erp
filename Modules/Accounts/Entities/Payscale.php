<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payscale extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'active_from', 'status'];

    public function salaryBasics()
    {
        return $this->hasMany(SalaryBasic::class);
    }
}
