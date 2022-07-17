<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Repositories\PensionNomineeRepository;

class PensionNomineeService
{
    use CrudTrait;
    /**
     * @var PensionNomineeRepository
     */
    private $pensionNomineeRepository;

    /**
     * PensionNomineeService constructor.
     * @param PensionNomineeRepository $pensionNomineeRepository
     */
    public function __construct(PensionNomineeRepository $pensionNomineeRepository)
    {
        $this->pensionNomineeRepository = $pensionNomineeRepository;
        $this->setActionRepository($pensionNomineeRepository);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function savePensionNominees(array $data)
    {
        try {
            //Todo:: Checkout the time format of nominee birth date
            DB::transaction(function () use ($data) {
                foreach ($data['nominee_entries'] as $nominee) {
                    $nominee['employee_id'] = $data['employee_id'];
                    $this->save($nominee);
                }
            });
            Session::flash('success', __('labels.save_success'));
            return true;
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.save_failed') . ', ' . $exception->getMessage());
            return false;
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function updatePensionNominees(array $data, $id): bool
    {
        try {
            $nominee = $this->findOne($id);
            if (!$nominee) {
                throw new \Exception('Nominee Not found!');
            }
            DB::transaction(function () use ($data, $nominee) {
                $nominees = $nominee->nominees;
                /**
                 * Syncing items by deleting/modifying and/or adding
                 */
                $nomineeDbIds = $nominees->pluck('id')->toArray();
                $nomineeRequestedIds = collect($data['nominee_entries'])->pluck('id')->toArray();
                $this->pensionNomineeRepository->deleteByIds(array_diff($nomineeDbIds, $nomineeRequestedIds));
                foreach ($data['nominee_entries'] as $requestedNominee) {
                    if ($requestedNominee['id']) {
                        $this->findOrFail($requestedNominee['id'])->update($requestedNominee);
                    } else {
                        $requestedNominee['employee_id'] = $data['employee_id'];
                        $this->save($requestedNominee);
                    }
                }
            });
            Session::flash('success', __('labels.update_success'));
            return true;
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.update_failed') . '!' . $exception->getMessage());
            return false;
        }
    }

    /**
     * Method that returns pension nominees prepared for dropdown
     * @param $employeeId
     * @return mixed
     */
    public function getNomineesForDropdown($employeeId)
    {
        return $this->pensionNomineeRepository
            ->getNomineesByEmployeeId($employeeId)
            ->each(function ($item) {
                return $item->nominee_name = App::getLocale() == 'bn' ? $item->bangla_name ?? $item->name : $item->name;
            })->pluck('nominee_name', 'id')->toArray();
    }
}

