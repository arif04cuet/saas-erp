<?php


namespace Modules\MMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\MMS\Entities\PrescriptionMedicine;

class PrescriptionMedicineRepository extends AbstractBaseRepository {

    protected $modelName = PrescriptionMedicine::class;

}
