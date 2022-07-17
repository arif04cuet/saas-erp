<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PmsCodeSettingDetail extends Model
{
    protected $fillable = ["pms_code_setting_id", "pms_sub_sector_id"];

    public function pmsCodeSetting()
    {
        return $this
            ->belongsTo(PmsCodeSetting::class, 'pms_code_setting_id', 'id')
            ->withDefault();
    }

    public function pmsSubSector()
    {
        return $this
            ->belongsTo(PmsSubSector::class, 'pms_sub_sector_id', 'id')
            ->withDefault();
    }
}
