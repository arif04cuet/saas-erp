<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    protected $fillable = ['name', 'remark'];
}
