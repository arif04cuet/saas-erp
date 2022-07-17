<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class RegisteredTraineeEducation extends Model
{
    protected $fillable = ['trainee_id', 'degree', 'subject', 'passing_year', 'institution'];
    protected $table = 'registered_trainee_education';
}
