<?php

namespace Modules\Publication\Entities;

use Modules\HRM\Entities\Employee;
use Illuminate\Database\Eloquent\Model;

class PublicationPress extends Model
{
    protected $table = "publication_presses";

    protected $fillable = ['press_name_en', 'press_name_bn', 'status', 'address', 'contact_number', 'press_user_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'press_user_id', 'id');
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return  $this->press_name_bn ?? trans('labels.not_found');
        } else {
            return  $this->press_name_en ?? trans('labels.not_found');
        }
    }
}
