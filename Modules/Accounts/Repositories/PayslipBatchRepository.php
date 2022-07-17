<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\PayslipBatch;

class PayslipBatchRepository extends AbstractBaseRepository {

    protected $modelName = PayslipBatch::class;

    public function getBatchesByPeriod($from, $to)
    {
        return $this->model->whereBetween('period_from', [$from, $to])
            ->whereBetween('period_to', [$from, $to])
            ->get();
    }

}
