<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Entities\TripBillPayment;
use Modules\VMS\Repositories\TripBillPaymentRepository;

class TripBillPaymentService
{
    use CrudTrait;

    public function __construct(TripBillPaymentRepository $tripBillPaymentRepository)
    {
        $this->setActionRepository($tripBillPaymentRepository);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $this->save($data);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            return false;
        }
    }

    public function changeStatus(TripBillPayment $tripBillPayment, $status)
    {
        $availableStatus = TripBillPayment::getPaymentStatus();
        if (!array_key_exists($status, $availableStatus)) {
            throw new \Exception('Status Is Not Available! ');
        }
        return $this->update($tripBillPayment, ['status' => $status]);
    }

    /**
     * @param array $data [contains trip id]
     * @return mixed
     */
    public function getTripExpenseByProject(array $data)
    {
        return $this->actionRepository->getTripExpenseByProject($data);

    }
}

