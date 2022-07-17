<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class JobApplicantExperience extends Model
{
   protected $fillable = [
        'id',
        'job_application_id',
        'designation',
        'organization_name',
        'length_of_service',
        'from',
        'to',
        'responsibilities'
   ];
}
