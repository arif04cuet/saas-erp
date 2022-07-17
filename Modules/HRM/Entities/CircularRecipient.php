<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class CircularRecipient extends Model
{
    protected $fillable = ['circular_id', 'recipient_id'];

    public function circular()
    {
        return $this->belongsTo(Circular::class, 'circular_id');
    }
}
