<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EconomyCodeSetting;
use Modules\Accounts\Repositories\EconomyCodeSettingRepository;
use function foo\func;

class EconomyCodeSettingService
{
    use CrudTrait;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var EconomyCodeSettingRepository
     */
    private $economyCodeSettingRepository;

    /**
     * EconomyCodeSettingService constructor.
     * @param EconomyCodeService $economyCodeService
     * @param EconomyCodeSettingRepository $economyCodeSettingRepository
     */
    public function __construct(
        EconomyCodeService $economyCodeService,
        EconomyCodeSettingRepository $economyCodeSettingRepository
    ) {
        $this->economyCodeService = $economyCodeService;
        $this->economyCodeSettingRepository = $economyCodeSettingRepository;
        $this->setActionRepository($economyCodeSettingRepository);
    }

    /**
     * @param array $data
     */
    public function saveCodeSettings(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                $codes = [];
                /**
                 * Syncing temporary codes
                 */
                foreach ($data['temporary_economy_codes'] as $temporaryEconomyCode) {
                    $codes[] = $temporaryEconomyCode;
                    if ($this->isCodeExist($temporaryEconomyCode)) {
                        continue;
                    }
                    $economyCodeData = [
                        'economy_code' => $temporaryEconomyCode,
                        'type' => config('constants.economy_code_types.temporary')
                    ];
                    $this->save($economyCodeData);
                }
                EconomyCodeSetting::whereNotIn('economy_code', $data['temporary_economy_codes'])
                    ->where('type', config('constants.economy_code_types.temporary'))->delete();
                /**
                 * Syncing receipt codes
                 */
                foreach ($data['receipt_economy_codes'] as $receiptEconomyCode) {
                    $codes[] = $receiptEconomyCode;
                    if ($this->isCodeExist($receiptEconomyCode)) {
                        continue;
                    }
                    $economyCodeData = [
                        'economy_code' => $receiptEconomyCode,
                        'type' => config('constants.economy_code_types.receipt')
                    ];
                    $this->save($economyCodeData);
                }
                EconomyCodeSetting::whereNotIn('economy_code', $data['receipt_economy_codes'])
                    ->where('type', config('constants.economy_code_types.receipt'))->delete();
            });
            Session::flash('success', __('labels.save_success'));
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.save_fail').' '.__('labels.error_code',
                    ['code' => $exception->getCode()]));
            return;
        }
    }

    private function isCodeExist($code)
    {
        return $this->findBy(['economy_code' => $code])->count() ? true : false;
    }

    public function getEconomyCodesForDropdown()
    {
        $implementedKey = function ($item) {
            return $item->code;
        };
        return $this->economyCodeService->getEconomyCodesForDropdown(
            null,
            $implementedKey,
            null,
            false
        );
    }

    public function getCodesFromSettings($type = null)
    {
        return $type? $this->findBy(['type' => $type]) : $this->findAll();
    }
}

