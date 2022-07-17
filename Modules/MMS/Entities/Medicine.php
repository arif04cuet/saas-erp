<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\IMS\Entities\InventoryItemCategory;

class Medicine extends Model
{
    protected $table='medicines';
    protected $fillable = ['name','generic_name','group_id', 'company_name','category_id'];

    public function inventoryCategory()
    {
        return $this->belongsTo(InventoryItemCategory::class,'category_id','id');
    }

    public function group()
    {
        return $this->belongsTo(MedicineGroup::class,'group_id','id');
    }

    public function category()
    {
        return $this->belongsTo(InventoryItemCategory::class,'category_id','id');
    }
}
