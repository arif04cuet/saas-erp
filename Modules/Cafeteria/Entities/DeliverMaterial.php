<?php

namespace Modules\Cafeteria\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class DeliverMaterial extends Model
{
    protected $fillable = ['title', 'deliver_date', 'department', 'user_id', 'status', 'remark', 'approval_note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliverItemLists()
    {
        return $this->hasMany(DeliverMaterialItem::class);
    }
}
