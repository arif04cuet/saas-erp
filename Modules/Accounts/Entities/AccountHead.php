<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    protected $fillable = [ 'parent_id', 'name', 'code', 'head_type', 'description'];

}
