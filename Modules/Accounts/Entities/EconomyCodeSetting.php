<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class EconomyCodeSetting extends Model
{
    protected $fillable = ['economy_code', 'type'];
}
