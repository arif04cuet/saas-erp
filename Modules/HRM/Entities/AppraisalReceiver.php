<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalReceiver extends Model
{
    protected $table = 'appraisal_receivers';
    protected $fillable = ['appraisal_id', 'receiver_id', 'is_initiator', 'signature', 'seal'];
}
