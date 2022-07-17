<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalContent extends Model
{
    protected $table = 'appraisal_contents';
    protected $fillable = ['name', 'type', 'class'];
}
