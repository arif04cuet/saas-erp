<?php


namespace Modules\MMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\MMS\Entities\Medicine;

class MedicineRepository extends AbstractBaseRepository
{

    protected $modelName = Medicine::class;

}
