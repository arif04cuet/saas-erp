<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/5/2018
 * Time: 11:31 AM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\EmployeePublication;

class EmployeePublicationRepository extends AbstractBaseRepository {
	protected $modelName = EmployeePublication::class;

}