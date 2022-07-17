<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class EconomyHead extends Model
{
    protected $fillable = ['parent_id', 'code', 'english_name', 'bangla_name', 'description'];

    public function economyCodes()
    {
        return $this->hasMany(EconomyCode::class, 'economy_head_code', 'code');
    }

    public function childHeads()
    {
        return $this->hasMany(EconomyHead::class, 'parent_id', 'code');
    }

    /**
     * Query Scope to get all the child heads
     */
    public function scopeTypeHeads($query)
    {
        return $query->where('code', '<', 10)->get();
    }

    /**
     * Accessor for getting head level
     * call it using (instance)->head_level
     * @return int
     */
    public function getHeadLevelAttribute()
    {
        return strlen($this->code);
    }
}
