<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\VMS\Entities\TripCalculationSetting;
use Modules\VMS\Services\TripCalculationSettingService;

class TripCalculationSettingController extends Controller
{
    /**
     * @var TripCalculationSettingService
     */
    private $tripCalculationSettingService;

    public function __construct(TripCalculationSettingService $tripCalculationSettingService)
    {
        $this->tripCalculationSettingService = $tripCalculationSettingService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $regularTripCalculationSettings = $this->tripCalculationSettingService
            ->findBy(['is_exceed_setting' => 0], null,
                ['column' => 'created_at', 'direction' => 'desc']);
        $exceedTripCalculationSettings = $this->tripCalculationSettingService
            ->findBy(['is_exceed_setting' => 1], null,
                ['column' => 'created_at', 'direction' => 'desc']);
        $statusCssArray = ['active' => 'success', 'inactive' => 'danger'];
        return view('vms::trip.setting.index',
            compact('statusCssArray', 'regularTripCalculationSettings', 'exceedTripCalculationSettings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $this->tripCalculationSettingService->clearSessionValues();
        return view('vms::trip.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->tripCalculationSettingService->store($request->all())) {
            return redirect()->route('vms.trip.setting.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('vms.trip.setting.index')->with('success', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('vms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param TripCalculationSetting $tripCalculationSetting
     * @return Response
     */
    public function edit(TripCalculationSetting $tripCalculationSetting)
    {
        $this->tripCalculationSettingService->setSessionValues($tripCalculationSetting);
        return view('vms::trip.setting.edit', compact('tripCalculationSetting'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TripCalculationSetting $tripCalculationSetting
     * @return RedirectResponse|Response
     */
    public function update(Request $request, TripCalculationSetting $tripCalculationSetting)
    {
        if ($this->tripCalculationSettingService->updateData($request->all(), $tripCalculationSetting)) {
            return redirect()->route('vms.trip.setting.index')->with('success', trans('labels.update_success'));
        } else {
            return redirect()->route('vms.trip.setting.index')->with('success', trans('labels.update_fail'));
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
