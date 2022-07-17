<?php

namespace Modules\IMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\JournalService;
use Modules\IMS\Repositories\ProcurementAndBillSettingRepository;
use mysql_xdevapi\Exception;

class ProcurementAndBillSettingService
{
    use CrudTrait;

    /**
     * @var ProcurementAndBillSettingRepository
     */
    private $billSettingRepository;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var JournalService
     */
    private $journalService;

    /**
     * ProcurementAndBillSettingService constructor.
     * @param ProcurementAndBillSettingRepository $billSettingRepository
     * @param EconomyCodeService $economyCodeService
     * @param JournalService $journalService
     */
    public function __construct(
        ProcurementAndBillSettingRepository $billSettingRepository,
        EconomyCodeService $economyCodeService,
        JournalService $journalService
    ) {
        $this->billSettingRepository = $billSettingRepository;
        $this->setActionRepository($billSettingRepository);
        $this->economyCodeService = $economyCodeService;
        $this->journalService = $journalService;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                if ($data['is_default']) {
                    $this->billSettingRepository->revokeDefaultSettings();
                }
                return $this->save($data);
            });

        } catch (\Exception $e) {
            Session::flash('error', __('labels.save_fail') . ', ' . __('labels.error_code',
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
    public function updateSetting(array $data, $id)
    {
        try {
            DB::transaction(function () use ($data, $id) {
                if ($data['is_default']) {
                    $this->billSettingRepository->revokeDefaultSettings();
                }
                $this->findOne($id)->update($data);
            });
            return true;

        } catch (Exception $e) {
            Session::flash('error', __('labels.update') . ', ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * Returns an array of elements required in bill settings create and edit form
     * @return array
     */
    public function getFormElements()
    {
        $economyCodes = $this->economyCodeService
            ->getEconomyCodesForDropdown(
                null,
                function ($element) {
                    return $element->code;
                },
                null,
                true
            );
        $journals = $this->journalService->getjournalsForDropdown();
        $billTypes = [];
        foreach (config('constants.inventory_bill_types') as $type) {
            $billTypes[$type] = __('ims::procurement.bill_types')[$type];
        }

        return [$economyCodes, $journals, $billTypes];
    }

    /**
     * @param \Closure|null $implementedValue
     * @param \Closure|null $implementedKey
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getEmployeesForDropdown(
        \Closure $implementedValue = null,
        \Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $settings = $query ? $this->findBy($query) : $this->findBy(['status' => 'active']);
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $settings,
            $implementedKey,
            $implementedValue ?: function ($setting) {
                return $setting->title;
            },
            $isEmptyOption
        );
    }

    /**
     * Returns active default setting if exists
     * @return mixed
     */
    public function getDefaultSetting()
    {
        return $this->findBy(['is_default' => 1, 'status' => 'active'])->first();
    }

}

