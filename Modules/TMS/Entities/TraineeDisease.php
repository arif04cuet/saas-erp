<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TraineeDisease extends Model
{
    protected $fillable = ['name'];
    protected $table = 'trainee_diseases';
}
