<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class EconomySector extends Model
{
    protected $fillable = ['code', 'parent_economy_code', 'title', 'title_bangla', 'description'];

    public function economyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'parent_economy_code', 'code');
    }
}
