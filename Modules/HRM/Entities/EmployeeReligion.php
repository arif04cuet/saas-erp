<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeReligion extends Model
{
    protected $fillable = [
        'bengali_title',
        'english_title',
        'description',
    ];

    public static function getIslamReligionId()
    {
        // no code column, so referencing to the Id from the config
        return config('constants.islam_religion_id');
    }

    public function getTitle()
    {
        $locale = trans('hrm::employee.religion.locale');

        return $this->$locale;
    }
}
