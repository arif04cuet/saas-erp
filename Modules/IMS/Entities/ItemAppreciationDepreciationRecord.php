<?php

namespace Modules\IMS\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class ItemAppreciationDepreciationRecord extends Model
{

    protected $fillable = ['inventory_item_id', 'type', 'value', 'reason', 'evaluation_date', 'created_by'];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
