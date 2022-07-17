<?php

namespace Modules\Accounts\Entities;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Database\Eloquent\Model;
use Modules\HM\Entities\HmCodeSetting;

class EconomyCode extends Model
{
    protected $fillable = ['code', 'english_name', 'bangla_name', 'description', 'economy_head_code'];


    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->bangla_name ?? trans('labels.not_found');
        } else {
            return $this->english_name ?? trans('labels.not_found');
        }
    }

    public function economyHead()
    {
        return $this->belongsTo(EconomyHead::class, 'economy_head_code', 'code');
    }

    public function economySectors()
    {
        return $this->hasMany(EconomySector::class, 'parent_economy_code', 'code');
    }

    public function hmCodeSetting()
    {
        return $this->hasOne(HmCodeSetting::class, 'economy_code', 'code');
    }

    public function getNameWithCode()
    {
        if (app()->isLocale('bn')) {
            return EnToBnNumberConverter::en2bn($this->code, false) . ' - ' . $this->bangla_name ??
                __('labels.not_found');
        } else {
            return $this->code . ' - ' . $this->english_name ?? __('labels.not_found');
        }
    }
}
