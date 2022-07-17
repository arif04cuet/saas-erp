<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalMetadata extends Model
{
    protected $table = "appraisal_metadata";

    protected $fillable = [
        'appraisal_id',
        'key',
        'value'
    ];
}
