<?php

namespace App\Entities\Sharing;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Designation;

class ShareRuleDesignation extends Model
{
    protected $table = 'share_rules_designations';

    public function getDesignation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
}
