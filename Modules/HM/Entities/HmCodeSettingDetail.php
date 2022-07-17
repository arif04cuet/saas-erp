<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class HmCodeSettingDetail extends Model
{
    protected $fillable = ['hm_code_setting_id', 'hostel_budget_section_id'];

    public function hmCodeSetting()
    {
        return $this
            ->belongsTo(HmCodeSetting::class, 'hm_code_setting_id', 'id')
            ->withDefault();
    }

    public function hostelBudgetSection()
    {
        return $this
            ->belongsTo(HostelBudgetSection::class, 'hostel_budget_section_id', 'id')
            ->withDefault();
    }

}
