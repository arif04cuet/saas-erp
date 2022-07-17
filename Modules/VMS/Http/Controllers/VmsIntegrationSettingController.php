<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\SalaryRuleService;
use Modules\TMS\Services\TmsSubSectorService;
use Modules\VMS\Entities\VmsIntegrationSetting;
use Modules\VMS\Services\VmsIntegrationSettingService;

class VmsIntegrationSettingController extends Controller
{
    /**
     * @var SalaryRuleService
     */
    private $salaryRuleService;
    /**
     * @var TmsSubSectorService
     */
    private $tmsSubSectorService;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var VmsIntegrationSettingService
     */
    private $vmsIntegrationSettingService;

    public function __construct(
        SalaryRuleService $salaryRuleService,
        TmsSubSectorService $tmsSubSectorService,
        VmsIntegrationSettingService $vmsIntegrationSettingService,
        EconomyCodeService $economyCodeService
    ) {
        $this->salaryRuleService = $salaryRuleService;
        $this->tmsSubSectorService = $tmsSubSectorService;
        $this->economyCodeService = $economyCodeService;
        $this->vmsIntegrationSettingService = $vmsIntegrationSettingService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index()
    {
        return view('vms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|RedirectResponse|View
     */
    public function create()
    {
        $activeSetting = $this->vmsIntegrationSettingService->getActiveSetting();
        if (!is_null($activeSetting)) {
            Session::flash('success', trans('vms::integration.flash_messages.already_found'));
            return redirect()->route('vms.integration.setting.show', $activeSetting);
        }
        $tmsSubSectors = $this->tmsSubSectorService->getTmsSubSectorsForDropdown();
        $implementKey = function ($economyCode) {
            return $economyCode->code;
        };
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(null, $implementKey);
        $salaryRules = $this->salaryRuleService->getRulesForDropdown();
        $this->vmsIntegrationSettingService->clearSessionValues();
        return view('vms::integration-setting.create', compact('tmsSubSectors', 'economyCodes', 'salaryRules'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $activeSetting = $this->vmsIntegrationSettingService->getActiveSetting();
        if (!is_null($activeSetting)) {
            Session::flash('error', trans('vms::integration.flash_messages.already_found'));
            return redirect()->route('vms.integration.setting.show', $activeSetting);
        }
        $setting = $this->vmsIntegrationSettingService->store($request->all());
        if ($setting) {
            return redirect()
                ->route('vms.integration.setting.show', $setting)
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()
                ->route('vms.integration.setting.create')
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param VmsIntegrationSetting $vmsIntegrationSetting
     * @return Factory|Application|RedirectResponse|View
     */
    public function show(VmsIntegrationSetting $vmsIntegrationSetting)
    {
        if (is_null($vmsIntegrationSetting)) {
            Session::flash('error', trans('vms::integration.flash_messages.not_found'));
            return redirect()->route('vms::integration-setting.create');
        }
        return view('vms::integration-setting.show', compact('vmsIntegrationSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param VmsIntegrationSetting $vmsIntegrationSetting
     * @return Factory|Application|Response|View
     */
    public function edit(VmsIntegrationSetting $vmsIntegrationSetting)
    {
        $tmsSubSectors = $this->tmsSubSectorService->getTmsSubSectorsForDropdown();
        $implementKey = function ($economyCode) {
            return $economyCode->code;
        };
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(null, $implementKey);
        $salaryRules = $this->salaryRuleService->getRulesForDropdown();
        $this->vmsIntegrationSettingService->setSessionValues($vmsIntegrationSetting);
        return view('vms::integration-setting.edit',
            compact('vmsIntegrationSetting', 'tmsSubSectors', 'economyCodes', 'salaryRules'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param VmsIntegrationSetting $vmsIntegrationSetting
     * @return RedirectResponse
     */
    public function update(Request $request, VmsIntegrationSetting $vmsIntegrationSetting)
    {
        $setting = $this->vmsIntegrationSettingService->updateData($request->all(), $vmsIntegrationSetting);
        if ($setting) {
            return redirect()
                ->route('vms.integration.setting.show', $setting)
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect()
                ->route('vms.integration.setting.show', $setting)
                ->with('error', trans('labels.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
