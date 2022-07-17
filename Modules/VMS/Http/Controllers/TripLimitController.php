<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\HRM\Services\DesignationService;
use Modules\TMS\Http\Requests\TrainingHeadRequest;
use Modules\VMS\Entities\TripLimit;
use Modules\VMS\Http\Requests\TripLimitRequest;
use Modules\VMS\Services\TripLimitService;

class TripLimitController extends Controller
{

    private $tripLimitService;
    private $designationService;

    public function __construct(TripLimitService $tripLimitService, DesignationService $designationService)
    {
        $this->tripLimitService = $tripLimitService;
        $this->designationService = $designationService;
    }


    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $designations = $this->designationService->getDesignationsForDropdown();
        $this->tripLimitService->clearSessionValues();
        return view('vms::trip.limit.create', compact('designations'));
    }

    public function index()
    {
        $tripLimits = $this->tripLimitService->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);
        return view('vms::trip.limit.index', compact('tripLimits'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TripLimitRequest $request)
    {
        if ($this->tripLimitService->save($request->all())) {
            return redirect()->route('vms.trip.limit.index')->with('success', trans('labels.save_success'));
        } else {
            $errorMessage = trans('labels.save_fail');
            if (Session::has('error')) {
                $errorMessage = Session::get('error');
            }
            return redirect()->route('vms::trip.limit.index')->with('error', $errorMessage);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param TripLimit $tripLimit
     * @return Factory|Application|Response|View
     */
    public function edit(TripLimit $tripLimit)
    {
        $this->tripLimitService->setSessionValues($tripLimit);
        $designations = $this->designationService->getDesignationsForDropdown();
        return view('vms::trip.limit.edit', compact('designations','tripLimit'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TripLimit $tripLimit
     * @return RedirectResponse
     */
    public function update(TripLimitRequest $request, TripLimit $tripLimit)
    {
        if ($this->tripLimitService->update($tripLimit, $request->all())) {
            return redirect()->route('vms.trip.limit.index')->with('success', trans('labels.update_success'));
        } else {
            $errorMessage = trans('labels.update_fail');
            if (Session::has('error')) {
                $errorMessage = Session::get('error');
            }
            return redirect()->route('vms::trip.limit.index')->with('error', $errorMessage);
        }
    }

}
