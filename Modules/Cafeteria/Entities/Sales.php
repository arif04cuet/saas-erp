<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;

class Sales extends Model
{
    protected $fillable = [
        'reference_type', 
        'reference', 
        'remark',
        'status',
        'paid',
        'due',
        'sales_date'
    ];

    public function employee() 
    {
        return $this->belongsTo(Employee::class, 'reference', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'reference', 'id');
    }

    public function salesItems()
    {
        return $this->hasMany(SalesItem::class);
    }

    public static function getPaymentTypes()
    {
        if (app()->isLocale('en')) {
            return Config::get('constants.cafeteria.sales_payment_types_en');
        } else {
            return Config::get('constants.cafeteria.sales_payment_types_bn');
        }
    }

    public static function getBillerTypes()
    {
        if (app()->isLocale('en')) {
            return Config::get('constants.cafeteria.sales_biller_types_en');
        } else {
            return Config::get('constants.cafeteria.sales_biller_types_bn');
        }
    }
}
