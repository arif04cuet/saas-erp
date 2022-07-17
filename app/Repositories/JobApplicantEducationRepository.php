<?php
/**
 * Created by PhpStorm.
 * User: Bs130
 * Date: 1/16/19
 * Time: 1:14 PM
 */

namespace App\Repositories;

use App\Entities\JobApplicantEducation;
use Illuminate\Support\Facades\DB;

class JobApplicantEducationRepository extends AbstractBaseRepository
{
    protected $modelName = JobApplicantEducation::class;
}