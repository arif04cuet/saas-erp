<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 9/18/19
 * Time: 5:21 PM
 */

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\AppraisalReviewee;
use Modules\HRM\Entities\AppraisalSetting;
use Modules\HRM\Repositories\AppraisalSettingRepository;

class AppraisalSettingService
{
    use CrudTrait;
    /**
     * @var AppraisalSettingRepository
     */
    private $appraisalSettingRepository;

    /**
     * AppraisalSettingService constructor.
     * @param AppraisalSettingRepository $appraisalSettingRepository
     */
    public function __construct(AppraisalSettingRepository $appraisalSettingRepository)
    {
        $this->setActionRepository($appraisalSettingRepository);
        /** @var AppraisalSettingRepository $appraisalSettingRepository */
        $this->appraisalSettingRepository = $appraisalSettingRepository;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $appraisalSetting = $this->save($data);

            $this->saveAppraisalSettingReviewees($data, $appraisalSetting);

            return $appraisalSetting;
        });
    }

    public function updateSetting(AppraisalSetting $appraisalSetting, array $data)
    {
        return DB::transaction(function () use ($appraisalSetting, $data) {
            $appraisalSetting->reviewees()->delete();

            $this->saveAppraisalSettingReviewees($data, $appraisalSetting);

            return $this->update($appraisalSetting, $data);
        });
    }

    /**
     * @param array $data
     * @param $appraisalSetting
     */
    private function saveAppraisalSettingReviewees(array $data, $appraisalSetting): void
    {
        $reviewees = collect($data['reviewees'])
            ->map(function ($employeeId) {
                return new AppraisalReviewee(['employee_id' => $employeeId]);
            });

        $appraisalSetting->reviewees()->saveMany($reviewees);
    }

    public function getReporterFromAppraisalSettings()
    {
        $reporters = $this->appraisalSettingRepository->findAll()
            ->mapWithKeys(function ($setting){
            return [$setting->id => $setting->reporter->getName(). ' - ' .$setting->reporter->getDesignation(). ' - ' .$setting->reporter->getDepartment()];
        })->toArray();
        return $reporters;
    }
}
