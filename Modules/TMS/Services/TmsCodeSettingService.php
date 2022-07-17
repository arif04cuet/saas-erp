<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\JournalService;
use Modules\TMS\Entities\TmsCodeSetting;
use Modules\TMS\Entities\TmsCodeSettingDetail;
use Modules\TMS\Repositories\TmsCodeSettingRepository;

class TmsCodeSettingService
{
    use CrudTrait;

    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var TmsSubSectorService
     */
    private $tmsSubSectorService;
    /**
     * @var JournalService
     */
    private $journalService;
    /**
     * @var TmsCodeSettingDetailService
     */
    private $tmsCodeSettingDetailService;

    public function __construct(
        TmsCodeSettingRepository $tmsCodeSettingRepository,
        EconomyCodeService $economyCodeService,
        TmsSubSectorService $tmsSubSectorService,
        TmsCodeSettingDetailService $tmsCodeSettingDetailService,
        JournalService $journalService
    ) {
        $this->setActionRepository($tmsCodeSettingRepository);
        $this->economyCodeService = $economyCodeService;
        $this->tmsSubSectorService = $tmsSubSectorService;
        $this->journalService = $journalService;
        $this->tmsCodeSettingDetailService = $tmsCodeSettingDetailService;
    }

    public function getEconomyCodesForDropdown()
    {
        $keyClosure = function ($c) {
            return $c->code;
        };
        return $this->economyCodeService->getEconomyCodesForDropdown(null, $keyClosure, null, false);
    }

    public function getJournalsForDropdown()
    {
        $tmsDepartmentCode = $this->getTrainingDepartmentCode();
        return $this->journalService->getDepartmentJournals($tmsDepartmentCode)->pluck('name', 'id');
    }

    public function getTmsSubSectorsForDropdown()
    {
        return $this->tmsSubSectorService->getTmsSubSectorsForDropdown();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            foreach ($data['code_settings'] as $codeSetting) {
                $tmsCodeSetting = $this->isEconomyCodeExist($codeSetting['economy_code']);
                if ($tmsCodeSetting) {
                    $tmsCodeSetting = $this->update($tmsCodeSetting,
                        ['economy_code' => $codeSetting['economy_code'], 'journal_id' => $codeSetting['journal_id']]);
                    $tmsCodeSetting->details()->delete();
                    $detailData = $this->prepareDetailData($tmsCodeSetting, $codeSetting['tms_sub_sector_id']);
                    $this->tmsCodeSettingDetailService->store($detailData);
                } else {
                    $tmsCodeSetting = $this->save($codeSetting);
                    $detailData = $this->prepareDetailData($tmsCodeSetting, $codeSetting['tms_sub_sector_id']);
                    $this->tmsCodeSettingDetailService->store($detailData);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Tms Code Setting Error: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data)
    {
        try {
            DB::beginTransaction();
            $this->deleteAllData();
            foreach ($data['code_settings'] as $codeSetting) {
                $tmsCodeSetting = $this->isEconomyCodeExist($codeSetting['economy_code']);;
                if (!$tmsCodeSetting) {
                    $tmsCodeSetting = $this->save($codeSetting);
                    $detailData = $this->prepareDetailData($tmsCodeSetting, $codeSetting['tms_sub_sector_id']);
                    $this->tmsCodeSettingDetailService->store($detailData);
                } else {
                    $tmsCodeSetting = $this->update($tmsCodeSetting,
                        ['economy_code' => $codeSetting['economy_code'], 'journal_id' => $codeSetting['journal_id']]);
                    $tmsCodeSetting->details()->delete();
                    $detailData = $this->prepareDetailData($tmsCodeSetting, $codeSetting['tms_sub_sector_id']);
                    $this->tmsCodeSettingDetailService->store($detailData);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Tms Code Setting Error: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function getCodeSettingBySubSectorId($subSectorId)
    {
        $detail = TmsCodeSettingDetail::where('tms_sub_sector_id', '=', $subSectorId)->first();
        return optional($detail)->tmsCodeSetting;
    }

    public function deleteAllData()
    {
        $this->actionRepository->getModel()::truncate();
        $this->tmsCodeSettingDetailService->deleteAlldata();
    }

    //---------------------------------------------------------------------------
    //                              Private Methods
    //---------------------------------------------------------------------------
    private function getTrainingDepartmentCode()
    {
        return config('tms.code');
    }

    private function prepareDetailData(TmsCodeSetting $tmsCodeSetting, array $data)
    {
        return collect($data)->map(function ($s) use ($tmsCodeSetting) {
            return [
                'tms_code_setting_id' => $tmsCodeSetting->id,
                'tms_sub_sector_id' => $s
            ];
        })->toArray();
    }

    /**
     * @param $economyCode
     * @return bool
     */
    private function isEconomyCodeExist($economyCode)
    {
        return $this->actionRepository->getSettingByEconomyCode($economyCode);
    }


}

