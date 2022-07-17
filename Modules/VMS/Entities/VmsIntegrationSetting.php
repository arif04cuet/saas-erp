<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\SalaryRule;
use Modules\TMS\Entities\TmsSubSector;

class VmsIntegrationSetting extends Model
{
    protected $fillable = [
        'salary_rule_id',
        'tms_sub_sector_id',
        'fuel_bill_economy_code',
        'vehicle_maintenance_economy_code',
        'project_economy_code',
        'accounts_bank_cash_economy_code',
        'tms_bank_cash_economy_code',
        'pms_bank_cash_economy_code',
        'status'
    ];

    public function salaryRule()
    {
        return $this->belongsTo(SalaryRule::class, 'salary_rule_id', 'id')->withDefault();

    }

    public function tmsSubSector()
    {
        return $this->belongsTo(TmsSubSector::class, 'tms_sub_sector_id', 'id')->withDefault();
    }

    public function fuelBill()
    {
        return $this->belongsTo(EconomyCode::class, 'fuel_bill_economy_code', 'code')->withDefault();
    }

    public function vehicleMaintenance()
    {
        return $this->belongsTo(EconomyCode::class, 'vehicle_maintenance_economy_code', 'code')->withDefault();
    }

    public function project()
    {
        return $this->belongsTo(EconomyCode::class, 'project_economy_code', 'code')->withDefault();
    }

    public function accountsBankCash()
    {
        return $this->belongsTo(EconomyCode::class, 'accounts_bank_cash_economy_code', 'code')->withDefault();
    }

    public function tmsBankCash()
    {
        return $this->belongsTo(TmsSubSector::class, 'tms_bank_cash_economy_code', 'id')->withDefault();
    }

    public function pmsBankCash()
    {
        return $this->belongsTo(EconomyCode::class, 'pms_bank_cash_economy_code', 'code')->withDefault();
    }
}
