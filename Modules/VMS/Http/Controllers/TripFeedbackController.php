<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\TripCalculationSetting;
use Modules\VMS\Services\TripService;

class TripFeedbackController extends Controller
{
    /**
     * @var TripService
     */
    private $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
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
     * @param Trip $trip
     * @return Factory|Application|View
     */
    public function create(Trip $trip)
    {
        return view('vms::trip.feedback.create', compact('trip'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $trip = $this->tripService->findOne($request['trip_id']);
        if ($this->tripService->update($trip, $request->all())) {
            return redirect()->route('vms.trip.index')->with('success', trans('labels.update_success'));
        } else {
            return redirect()->route('vms.trip.index')->with('success', trans('labels.update_fail'));
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
    public function edit($id)
    {
        return view('vms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
