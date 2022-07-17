<?php

namespace Modules\IMS\Entities;

use App\Entities\StateDetail;
use App\Entities\User;
use App\Traits\Workflowable;
use Iben\Statable\Models\StateHistory;
use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;
use Modules\IMS\Entities\InventoryLocation;
use Modules\TMS\Entities\Training;
use phpDocumentor\Reflection\Types\This;

class InventoryItemRequest extends Model
{

    use Workflowable;

    protected $fillable = [
        'requester_id',
        'inventory_location_id',
        'requestId',
        'title',
        'purpose',
        'reason',
        'reference_entity',
        'reference_entity_id',
        'status'
    ];

    public static function getPurpose($keysOnly = false)
    {
        if ($keysOnly) {
            return array_keys(config('ims.constants.item.request.purpose'));
        }
        return config('ims.constants.item.request.purpose');
    }

    public static function getStatus($keysOnly = false)
    {
        if ($keysOnly) {
            return array_keys(config('ims.constants.item.request.status'));
        }
        return config('ims.constants.item.request.status');
    }

    // model relation
    public function details()
    {
        return $this->hasMany(InventoryItemRequestDetail::class, 'inventory_item_request_id', 'id');
    }

    public function requester(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id', 'id')->withDefault();
    }

    public function inventoryLocation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InventoryLocation::class, 'inventory_location_id', 'id')->withDefault();
    }

    public function referenceEntity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo($this->reference_entity, 'reference_entity_id', 'id')
            ->withDefault();
    }


    protected function getGraph()
    {
        return 'inventory-item-request-workflow';
    }

    public function stateDetails()
    {
        return $this->hasManyThrough(StateDetail::class, StateHistory::class, 'statable_id', 'state_history_id', 'id',
            'id')
            ->where('statable_type', InventoryRequest::class);
    }


}
