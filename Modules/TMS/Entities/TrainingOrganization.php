<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingOrganization extends Model
{
    protected $table = 'training_organizations';
    protected $fillable = [
        'unique_id',
        'name',
        'bangla_name',
        'type',
        'address',
        'contact_person',
        'contact_person_email',
        'contact_person_cc',
        'contact_person_phone',
        'note',
    ];

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->bangla_name ?? trans('labels.not_found');
        }
        return $this->name ?? trans('labels.not_found');
    }
}
