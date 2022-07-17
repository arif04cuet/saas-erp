<?php

namespace App\Entities\Sharing;

use Illuminate\Database\Eloquent\Model;

class ShareRule extends Model
{
    protected $table = 'share_rules';

    public function rulesDesignation()
    {
       return $this->hasMany(ShareRuleDesignation::class);
    }
}
