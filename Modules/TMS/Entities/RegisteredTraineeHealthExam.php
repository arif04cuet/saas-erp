<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class RegisteredTraineeHealthExam extends Model
{
    protected $fillable = ['trainee_id', 'present_deseases', 'physical_disability', 'temperature', 'pulse', 'respiration', 'conjunctiva', 'oral_cavity', 'denture', 'blood_pressure', 'anaemia', 'oedema', 'heart', 'lung', 'abdomen', 'eye_sight', 'left_eye', 'right_eye'];

    protected $table = 'registered_trainee_healthExam';
}
