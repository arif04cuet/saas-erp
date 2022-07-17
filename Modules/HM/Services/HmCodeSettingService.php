<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\JournalService;
use Modules\HM\Entities\HmCodeSetting;
use Modules\HM\Repositories\HmCodeSettingRepository;

class HmCodeSettingService
{
    use CrudTrait;

    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var HmCodeSettingDetailService
     */
    private $hmCodeSettingDetailService;
    /**
     * @var JournalService
     */
    private $journalService;
    /**
     * @var HostelBudgetSectionService
     */
    private $hostelBudgetSectionService;

    public function __construct(
        HmCodeSettingRepository $hmCodeSettingRepository,
        EconomyCodeService $economyCodeService,
        HostelBudgetSectionService $hostelBudgetSectionService,
        HmCodeSettingDetailService $hmCodeSettingDetailService,
        JournalService $journalService
    ) {
        $this->setActionRepository($hmCodeSettingRepository);
        $this->economyCodeService = $economyCodeService;
        $this->hostelBudgetSectionService = $hostelBudgetSectionService;
        $this->hmCodeSettingDetailService = $hmCodeSettingDetailService;
        $this->journalService = $journalService;
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
        $hostelDepartmentCode = $this->getHostelDepartmentCode();
        return $this->journalService->getDepartmentJournals($hostelDepartmentCode)->pluck('name', 'id');
    }

    public function getHostelBudgetSectionForDropdown()
    {
        return $this->hostelBudgetSectionService->getHostelBudgetSectionsForDropdown();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            foreach ($data['code_settings'] as $codeSetting) {
                $hmCodeSetting = $this->isEconomyCodeExist($codeSetting['economy_code']);
                if ($hmCodeSetting) {
                    $hmCodeSetting = $this->update(
                        $hmCodeSetting,
                        ['economy_code' => $codeSetting['economy_code'], 'journal_id' => $codeSetting['journal_id']]
                    );
                    $hmCodeSetting->details()->delete();
                    $detailData = $this->prepareDetailData($hmCodeSetting, $codeSetting['hostel_budget_section_id']);
                    $this->hmCodeSettingDetailService->store($detailData);
                } else {
                    $hmCodeSetting = $this->save($codeSetting);
                    $detailData = $this->prepareDetailData($hmCodeSetting, $codeSetting['hostel_budget_section_id']);
                    $this->hmCodeSettingDetailService->store($detailData);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("HM Code Setting Error: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data)
    {

        try {
            DB::beginTransaction();
            $this->deleteAllData();
            foreach ($data['code_settings'] as $codeSetting) {
                $hmCodeSetting = $this->isEconomyCodeExist($codeSetting['economy_code']);;
                if (!$hmCodeSetting) {
                    $hmCodeSetting = $this->save($codeSetting);
                    $detailData = $this->prepareDetailData($hmCodeSetting, $codeSetting['hostel_budget_section_id']);
                    $this->hmCodeSettingDetailService->store($detailData);
                } else {
                    $hmCodeSetting = $this->update(
                        $hmCodeSetting,
                        ['economy_code' => $codeSetting['economy_code'], 'journal_id' => $codeSetting['journal_id']]
                    );
                    $hmCodeSetting->details()->delete();
                    $detailData = $this->prepareDetailData($hmCodeSetting, $codeSetting['hostel_budget_section_id']);
                    $this->hmCodeSettingDetailService->store($detailData);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Hm Code Setting Error: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function getCodeSettingByHostelBudgetSectionId($hostelBudgetSectionId)
    {
        $detail = $this->hmCodeSettingDetailService->findBy(['hostel_budget_section_id' => $hostelBudgetSectionId])->first();
        return optional($detail)->hmCodeSetting;
    }

    public function getEconomyCodesFromHmCodeSetting()
    {
        return $this->findAll()->pluck('economy_code');
    }

    public function deleteAllData()
    {
        $this->actionRepository->getModel()::truncate();
        $this->hmCodeSettingDetailService->deleteAlldata();
    }

    //---------------------------------------------------------------------------
    //                              Private Methods
    //---------------------------------------------------------------------------
    private function getHostelDepartmentCode()
    {
        return config('hm.code');
    }

    private function prepareDetailData(HmCodeSetting $hmCodeSetting, array $data)
    {
        return collect($data)->map(function ($s) use ($hmCodeSetting) {
            return [
                'hm_code_setting_id' => $hmCodeSetting->id,
                'hostel_budget_section_id' => $s
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
