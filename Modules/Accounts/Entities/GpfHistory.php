<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class GpfHistory extends Model
{
    protected $fillable = ['employee_id', 'percentage', 'status'];
}
