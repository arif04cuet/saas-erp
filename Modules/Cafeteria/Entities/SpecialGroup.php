<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class SpecialGroup extends Model
{
    protected $fillable = ['bn_name', 'en_name', 'total_no', 'remark', 'charge', 'rent','advance_amount'];

    public function purchaseLists()
    {  
        return $this->hasMany(SpecialPurchaseList::class);
    }

    public function specialBills()
    {
        return $this->hasMany(SpecialGroupBill::class);
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->bn_name ?? trans('lables.not_found');
        } else {
            return $this->en_name ?? trans('lables.not_found');
        }
    }
}
