<?php
/**
 * Created by PhpStorm.
 * User: Bs130
 * Date: 1/16/19
 * Time: 1:14 PM
 */

namespace App\Repositories;


use App\Entities\JobApplication;
use Illuminate\Support\Facades\DB;

class JobApplicationRepository extends AbstractBaseRepository
{
    protected $modelName = JobApplication::class;
}