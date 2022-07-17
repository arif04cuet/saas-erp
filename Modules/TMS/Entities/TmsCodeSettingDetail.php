<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TmsCodeSettingDetail extends Model
{
    protected $fillable = ["tms_code_setting_id", "tms_sub_sector_id"];

    public function tmsCodeSetting()
    {
        return $this
            ->belongsTo(TmsCodeSetting::class, 'tms_code_setting_id', 'id')
            ->withDefault();
    }

    public function tmsSubSector()
    {
        return $this
            ->belongsTo(TmsSubSector::class, 'tms_sub_sector_id', 'id')
            ->withDefault();
    }
}
