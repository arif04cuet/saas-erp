<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class RegisteredTraineeGeneralInfo extends Model
{
    protected $fillable = [
        'trainee_id',
        'fathers_name',
        'fathers_name_bn',
        'mothers_name',
        'mothers_name_bn',
        'birth_place',
        'marital_status',
        'present_address',
        'present_address_bn'
    ];
    protected $table = 'registered_trainee_generalInfos';

}
