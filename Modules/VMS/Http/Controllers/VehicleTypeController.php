<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\VMS\Entities\VehicleType;
use Modules\VMS\Http\Requests\VehicleTypeRequest;
use Modules\VMS\Services\VehicleTypeService;
use MongoDB\Driver\Session;

class VehicleTypeController extends Controller
{

    private $service;

    public function __construct(VehicleTypeService $vehicleTypeService)
    {
        $this->service = $vehicleTypeService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $vehicleTypes = $this->service->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);
        return view('vms::vehicle.type.index', compact('vehicleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $this->service->clearSessionValues();
        return view('vms::vehicle.type.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param VehicleTypeRequest $request
     * @return RedirectResponse
     */
    public function store(VehicleTypeRequest $request): RedirectResponse
    {
        if ($this->service->save($request->all())) {
            \Illuminate\Support\Facades\Session::flash('success', trans('labels.save_success'));
            return redirect()->route('vms.vehicle-types.index');
        } else {
            if (\Illuminate\Support\Facades\Session::has('error')) {
                \Illuminate\Support\Facades\Session::flash('error', \Illuminate\Support\Facades\Session::get('error'));
            } else {
                \Illuminate\Support\Facades\Session::flash('error', trans('labels.save_fail'));
                return redirect()->route('vms.vehicle-types.index');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param VehicleType $vehicleType
     * @return Factory|Application|Response|View
     */
    public function edit(VehicleType $vehicleType)
    {
        $this->service->createSessionValues($vehicleType);
        return view('vms::vehicle.type.edit', compact('vehicleType'));
    }

    /**
     * Update the specified resource in storage.
     * @param VehicleTypeRequest $request
     * @param VehicleType $vehicleType
     * @return Response
     */
    public function update(VehicleTypeRequest $request, VehicleType $vehicleType)
    {
        if ($this->service->update($vehicleType, $request->all())) {
            \Illuminate\Support\Facades\Session::flash('success', trans('labels.update_success'));
            return redirect()->route('vms.vehicle-types.create');
        } else {
            if (\Illuminate\Support\Facades\Session::has('error')) {
                \Illuminate\Support\Facades\Session::flash('error', \Illuminate\Support\Facades\Session::get('error'));
            } else {
                \Illuminate\Support\Facades\Session::flash('error', trans('labels.update_fail'));
                return redirect()->route('vms.vehicle-types.create');
            }
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
