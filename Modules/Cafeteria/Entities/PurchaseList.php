<?php

namespace Modules\Cafeteria\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Cafeteria\Entities\PurchaseItemList;

class PurchaseList extends Model
{
    protected $table = "purchase_lists";

    protected $fillable = ['title', 'purchase_date', 'status', 'remark', 'approval_note', 'user_id'];

    public function purchaseItemLists() 
    {
        return $this->hasMany(PurchaseItemList::class, 'purchase_list_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
