<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/29/2018
 * Time: 4:14 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\AcademicDegree;

class AcademicDegreeRepository extends AbstractBaseRepository {
	protected $modelName = AcademicDegree::class;

}