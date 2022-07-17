<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Repositories\EmployeeLoanCircularRepository;

class EmployeeLoanCircularService
{
    use CrudTrait;
    /**
     * @var EmployeeLoanCircularRepository
     */
    private $loanCircularRepository;

    /**
     * EmployeeLoanCircularService constructor.
     * @param EmployeeLoanCircularRepository $loanCircularRepository
     */
    public function __construct(EmployeeLoanCircularRepository $loanCircularRepository)
    {
        $this->loanCircularRepository = $loanCircularRepository;
        $this->setActionRepository($loanCircularRepository);
    }

    /**
     * @param array $data
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            $data['circular_date'] = Carbon::parse($data['circular_date'])->format('Y-m-d');
            $data['last_date_of_application'] = Carbon::parse($data['last_date_of_application'])->format('Y-m-d');
            $data['status'] = 'active';
            return $this->save($data);

        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function updateCircular(array $data, $id)
    {
        try {
            $circular = $this->findOne($id);
            $data['circular_date'] = Carbon::parse($data['circular_date'])->format('Y-m-d');
            $data['last_date_of_application'] = Carbon::parse($data['last_date_of_application'])->format('Y-m-d');
            return $circular->update($data);

        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param bool $activeOnly
     * @param bool $emptyOption
     * @return array
     */
    public function getCircularsForDropdown($activeOnly = true, $emptyOption = true)
    {
        $circulars = $activeOnly ? $this->loanCircularRepository->getActiveCirculars() : $this->findAll();
        return ($emptyOption ? ['' => __('labels.select')] : []) + $circulars->each(function ($circular) {
                return $circular->title = $circular->title.' - '.$circular->reference_no . ' - (' .
                    Carbon::parse($circular->last_date_of_application)->format('d/m/Y') . ')';
            })->pluck('title', 'id')->toArray();
    }
}

