<?php
/**
 * Created by PhpStorm.
 * User: Bs130
 * Date: 1/16/19
 * Time: 1:14 PM
 */

namespace App\Repositories;

use App\Entities\JobApplicantAddress;
use Illuminate\Support\Facades\DB;

class JobApplicantAddressRepository extends AbstractBaseRepository
{
    protected $modelName = JobApplicantAddress::class;
}