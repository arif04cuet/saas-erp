<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Repositories\ProjectRepository;
use Modules\VMS\Entities\TripBillPayment;

class TripBillPaymentRepository extends AbstractBaseRepository
{
    protected $modelName = TripBillPayment::class;


    public function getTripExpenseByProject(array $data)
    {
        return $this->getModel()
            ->newQuery()
            ->whereIn('trip_id', $data)
            ->selectRaw('
                MAX(id) as id,
                trip_id,
                SUM(amount) as total')
            ->groupBy('trip_id')
            ->get();
    }
}
