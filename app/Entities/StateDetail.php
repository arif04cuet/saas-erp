<?php

namespace App\Entities;

use Iben\Statable\Models\StateHistory;
use Illuminate\Database\Eloquent\Model;

class StateDetail extends Model
{
    //

    protected $fillable = ['state_history_id', 'remark', 'message', 'created_at', 'updated_at'];

    public function stateHistory()
    {
        return $this->belongsTo(StateHistory::class, 'state_history_id', 'id');
    }
}
