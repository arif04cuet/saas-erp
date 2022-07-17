<?php

namespace Modules\HRM\Services;

use App\Entities\District;
use App\Entities\Division;
use App\Entities\Thana;
use App\Entities\Union;

class LocationService
{


    public function getDivisionsForDropdown()
    {
        return Division::all()->each(function ($d) {
            $name = $d->name;
            if (empty($name)) {
                $name = $d->bn_name;
            }
            if (empty($name)) {
                $name = trans('labels.not_found');
            }
            $d->name = $name;
            return $d;
        })->pluck('name', 'id');

    }

    public function getDistrictsForDropdown()
    {
        return District::all()->each(function ($d) {
            $name = $d->name;
            if (empty($name)) {
                $name = $d->bn_name;
            }
            if (empty($name)) {
                $name = trans('labels.not_found');
            }
            $d->name = $name;
            return $d;
        })->pluck('name', 'id');

    }

    public function getThanasForDropdown()
    {
        return Thana::all()->each(function ($d) {
            $name = $d->name;
            if (empty($name)) {
                $name = $d->bn_name;
            }
            if (empty($name)) {
                $name = trans('labels.not_found');
            }
            $d->name = $name;
            return $d;
        })->pluck('name', 'id');

    }

    public function getUnionsForDropdown()
    {
        return Union::all()->each(function ($d) {
            $name = $d->name;
            if (empty($name)) {
                $name = $d->bn_name;
            }
            if (empty($name)) {
                $name = trans('labels.not_found');
            }
            $d->name = $name;
            return $d;
        })->pluck('name', 'id');

    }


}

