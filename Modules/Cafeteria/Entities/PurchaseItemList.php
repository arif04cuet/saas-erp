<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Modules\Cafeteria\Entities\PurchaseList;

class PurchaseItemList extends Model
{

    protected $table = "purchase_item_lists";

    protected $fillable = [
        'purchase_list_id',
        'raw_material_id',
        'quantity',
        'unit_id',
        'unit_price',
        'total_price',
        'status',
        'purchase_date'
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public static function getReportTypes()
    {
        if (app()->isLocale('en')) {
            return Config::get('constants.cafeteria.purchase_report_type_en');
        } else {
            return Config::get('constants.cafeteria.purchase_report_type_bn');
        }
    }
}
