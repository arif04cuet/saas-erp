<?php

namespace Modules\IMS\Entities;

use App\Entities\StateDetail;
use App\Entities\User;
use App\Traits\Workflowable;
use Iben\Statable\Models\StateHistory;
use Iben\Statable\Statable;
use Illuminate\Database\Eloquent\Model;

class InventoryRequest extends Model
{
    use Workflowable;

    protected $fillable = [
        'title',
        'type',
        'purpose',
        'from_location_id',
        'to_location_id',
        'requester_id',
        'receiver_id',
        'status'
    ];

    public function details()
    {
        return $this->hasMany(InventoryRequestDetail::class, 'inventory_request_id', 'id');
    }

    public function requester()
    {
        return $this->hasOne(User::class, 'id', 'requester_id');
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }

    public function fromLocation()
    {
        return $this->hasOne(InventoryLocation::class, 'id', 'from_location_id');
    }

    public function toLocation()
    {
        return $this->hasOne(InventoryLocation::class, 'id', 'to_location_id');
    }

    protected function getGraph()
    {
        return 'workflow';
    }

    public function stateDetails()
    {
        return $this->hasManyThrough(StateDetail::class, StateHistory::class, 'statable_id', 'state_history_id', 'id',
            'id')
            ->where('statable_type', InventoryRequest::class);
    }

    public function approvedItems()
    {
        return $this->hasMany(InventoryRequestItem::class);
    }

}
