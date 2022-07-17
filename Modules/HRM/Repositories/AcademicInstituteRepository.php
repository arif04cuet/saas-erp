<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/25/2018
 * Time: 6:02 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\AcademicInstitute;
use Modules\HRM\Entities\Institute;

class AcademicInstituteRepository extends AbstractBaseRepository {
	protected $modelName = AcademicInstitute::class;


}