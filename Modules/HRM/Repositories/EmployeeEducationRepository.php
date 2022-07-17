<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/23/2018
 * Time: 4:44 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\EmployeeEducation;


class EmployeeEducationRepository extends AbstractBaseRepository {

	protected $modelName = EmployeeEducation::class;
}