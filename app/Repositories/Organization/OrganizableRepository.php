<?php
/**
 * Created by PhpStorm.
 * User: bs100
 * Date: 1/15/19
 * Time: 7:36 PM
 */

namespace App\Repositories\Organization;


use App\Entities\Organization\Organizable;
use App\Repositories\AbstractBaseRepository;
//use Modules\PMS\Entities\Organizable;

class OrganizableRepository extends AbstractBaseRepository
{
    protected $modelName = Organizable::class;

}