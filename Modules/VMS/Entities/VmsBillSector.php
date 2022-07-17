<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VmsBillSector extends Model
{
    protected $fillable = [
        'title_english',
        'title_bangla',
        'amount'
    ];

    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->title_bangla ?? trans('labels.not_found');
        }
        return $this->title_english ?? trans('labels.not_found');
    }

    public function vmsBillSectorAssigns()
    {
        return $this->hasMany(VmsBillSectorAssign::class, 'vms_bill_sector_id', 'id');
    }


}
