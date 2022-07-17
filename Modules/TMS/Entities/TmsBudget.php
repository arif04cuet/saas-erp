<?php

namespace Modules\TMS\Entities;

use App\Traits\DoptorAbleTrait;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TmsBudget extends Model
{
    use DoptorAbleTrait;
    protected $table = 'training_budgets';
    protected $fillable = [
        'name_english',
        'name_bangla'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('authenticated', function (Builder $builder) {
            $builder->where('doptor_id', '=', Auth::user()->doptor_id);
        });
    }

    public static function getLevels()
    {
        return config('tms.training.level');
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->name_bangla ?? trans('labels.not_found');
        }
        return $this->name_english ?? trans('labels.not_found');
    }

    public function tmsBudget()
    {
        return $this->hasOne(Training::class, 'id', 'budget_id');
    }

    public static function getBudgetSources($keysOnly = false)
    {
        if ($keysOnly) {
            return array_keys(config('constants.tms_budget_sources'));
        }
        return config('constants.tms_budget_sources');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'id', 'budget_id');
    }

    public function budgetSectors()
    {
        return $this->hasMany(TmsBudgetSector::class);
    }
}
