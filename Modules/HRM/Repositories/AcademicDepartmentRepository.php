<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/28/2018
 * Time: 4:52 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\AcademicDepartment;

class AcademicDepartmentRepository extends AbstractBaseRepository {
	protected $modelName = AcademicDepartment::class;

}