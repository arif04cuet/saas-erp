<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class MedicineCompany extends Model
{
    protected $fillable = ['name', 'address','email','contact_person_name', 'contact_person_mobile'];

}
