<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class RegisteredTraineeEmergency extends Model
{
    protected $fillable = ['trainee_id', 'name', 'mobile_no', 'relation', 'contact_address'];
    protected $table = 'registered_trainee_emergency';
}
