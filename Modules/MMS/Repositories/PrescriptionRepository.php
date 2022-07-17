<?php


namespace Modules\MMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\MMS\Entities\Prescription;

class PrescriptionRepository extends AbstractBaseRepository
{

    protected $modelName = Prescription::class;

    public function prescriptionList()
    {
        return $this->model->select('id', 'patient_id', 'name', 'mobile_no', 'date')
            ->get();
    }

}
