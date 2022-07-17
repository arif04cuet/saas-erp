<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class JobApplicantResearch extends Model
{
    protected $fillable = ['job_application_id', 'title', 'duration', 'from', 'to', 'supervisor', 'organaization'];
}
