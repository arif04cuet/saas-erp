<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\Journal;

class TmsCodeSetting extends Model
{
    protected $fillable = ["economy_code", "journal_id", "status"];

    public static function getStatuses($keysOnly = false)
    {
        if ($keysOnly) {
            return array_keys(config('tms.constants.accounts.code_setting.statuses'));
        } else {
            return config('tms.constants.accounts.code_setting.statuses');
        }
    }

    public function economyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'economy_code', 'code')->withDefault();
    }

    public function details()
    {
        return $this->hasMany(TmsCodeSettingDetail::class, 'tms_code_setting_id', 'id');
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id', 'id')->withDefault();
    }


}
