<?php
/**
 * Created by PhpStorm.
 * User: bs100
 * Date: 1/17/19
 * Time: 5:14 PM
 */

namespace App\Repositories\Organization;


use App\Entities\Organization\OrganizationMember;
use App\Repositories\AbstractBaseRepository;

class OrganizationMemberRepository extends AbstractBaseRepository
{
    protected $modelName = OrganizationMember::class;
}