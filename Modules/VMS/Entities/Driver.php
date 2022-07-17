<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['name_english', 'name_bangla', 'date_of_birth', 'address', 'license_number'];

    public static function getStatuses($keysOnly = false)
    {
        $statuses = config('vms.driver.status');
        if ($keysOnly) {
            return array_keys($statuses);
        }
        return $statuses;
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->name_bangla ?? trans('labels.not_found');
        }
        return $this->name_english ?? trans('labels.not_found');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
