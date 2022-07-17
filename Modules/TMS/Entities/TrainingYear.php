<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingYear extends Model
{

    protected $fillable = [
        'start_date',
        'end_date',
    ];

    public function getYear()
    {
        if (app()->isLocale('bn')) {
            return $this->start_date.' - '.$this->end_date;
        }
    }

}
