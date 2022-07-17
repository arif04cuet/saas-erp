<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class PensionRule extends Model
{
    protected $fillable = [
        'pension_configuration_id',
        'name',
        'type',
        'condition',
        'amount_type',
        'percentage_amount',
        'fixed_amount'
    ];

    public function pensionConfiguration()
    {
        return $this->belongsTo(PensionConfiguration::class, 'pension_configuration_id', 'id')
            ->withDefault();
    }

    public static function getType()
    {
        return Config::get('constants.pension.rule.type');
    }

    public static function getCondition()
    {
        return Config::get('constants.pension.rule.condition');
    }

    public static function getAmountType()
    {
        return Config::get('constants.pension.rule.amount_type');
    }

}
