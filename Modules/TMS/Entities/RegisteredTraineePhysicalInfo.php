<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class RegisteredTraineePhysicalInfo extends Model
{
    protected $fillable = ['trainee_id', 'joining_age', 'expertise_sports', 'hobby', 'sports_experience', 'hieght', 'weight', 'normal_chest', 'expended_chest', 'weight_end_course'];

    protected $table = 'registered_trainee_physicalInfos';
}
