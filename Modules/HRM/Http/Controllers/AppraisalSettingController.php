<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\AppraisalSetting;
use Modules\HRM\Http\Requests\StoreUpdateAppraisalSettingRequest;
use Modules\HRM\Services\AppraisalSettingService;
use Modules\HRM\Services\EmployeeService;

class AppraisalSettingController extends Controller
{
    const APPRAISAL_SETTING_VIEW = 'hrm::appraisal.setting.';

    private $employeeService;
    private $appraisalSettingService;

    /**
     * AppraisalSettingController constructor.
     * @param AppraisalSettingService $appraisalSettingService
     * @param EmployeeService $employeeService
     */
    public function __construct(AppraisalSettingService $appraisalSettingService, EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
        $this->appraisalSettingService = $appraisalSettingService;
    }

    public function index()
    {
        $appraisalSettings = $this->appraisalSettingService->findAll(null, null, ['column' => 'id', 'direction' => 'desc']);

        return view(self::APPRAISAL_SETTING_VIEW . '.index', compact('appraisalSettings'));
    }

    public function create()
    {
        $employees = $this->employeeDropdownKeyValue();

        return view(self::APPRAISAL_SETTING_VIEW . 'create', compact('employees'));
    }

    public function store(StoreUpdateAppraisalSettingRequest $request)
    {
        if ($this->appraisalSettingService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('appraisals.settings.index');
    }

    public function show(AppraisalSetting $appraisalSetting)
    {
        return view(self::APPRAISAL_SETTING_VIEW . 'show', compact('appraisalSetting'));
    }

    public function edit(AppraisalSetting $appraisalSetting)
    {
        $employees = $this->employeeDropdownKeyValue();

        return view(self::APPRAISAL_SETTING_VIEW . 'edit', compact('appraisalSetting', 'employees'));
    }

    public function update(StoreUpdateAppraisalSettingRequest $request, AppraisalSetting $appraisalSetting)
    {
        if ($this->appraisalSettingService->updateSetting($appraisalSetting, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('appraisals.settings.index');
    }

    /**
     * @return \App\Repositories\Contracts\Collection|
     * \Illuminate\Contracts\Pagination\LengthAwarePaginator|
     * \Illuminate\Database\Eloquent\Builder[]|
     * \Illuminate\Database\Eloquent\Collection|
     * \Illuminate\Database\Eloquent\Model[]
     */
    private function employeeDropdownKeyValue()
    {
        return $this->employeeService->findAll()
            ->mapWithKeys($this->employeeService->empDefaultDropdown());
    }

    public function getSettingById($id)
    {
        $setting = $this->appraisalSettingService->findOrFail($id);
        return $setting;
    }

    public function getSignerById($id)
    {
        $signer = $this->employeeService->findOrFail($id);
        return $signer->getName(). ' - ' .$signer->getDesignation(). ' - ' .$signer->getDepartment();
    }

    public function getCommenterById($id)
    {
        $commenter = $this->employeeService->findOrFail($id);
        return $commenter->getName(). ' - ' .$commenter->getDesignation(). ' - ' .$commenter->getDepartment();
    }
}
