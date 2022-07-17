<?php


namespace Modules\MMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\MMS\Entities\Patient;

class PatientRepository extends AbstractBaseRepository
{

    protected $modelName = Patient::class;


}
