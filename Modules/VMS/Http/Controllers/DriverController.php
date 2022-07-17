<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\VMS\Entities\Driver;
use Modules\VMS\Http\Requests\DriverRequest;
use Modules\VMS\Services\DriverService;

class DriverController extends Controller
{
    /**
     * @var DriverService
     */
    private $driverService;

    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index()
    {
        $drivers = $this->driverService->findAll();
        return view('vms::driver.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->driverService->clearSessionValues();
        return view('vms::driver.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param DriverRequest $request
     * @return RedirectResponse
     */
    public function store(DriverRequest $request)
    {
        if ($this->driverService->store($request->all())) {
            return redirect()
                ->route('vms.drivers.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()
                ->route('vms.drivers.index')
                ->with('error', trans('labels.save_fail'));
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
     * @param Driver $driver
     * @return Factory|Application|View
     */
    public function edit(Driver $driver)
    {
        $this->driverService->setSessionValues($driver);
        return view('vms::driver.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Driver $driver
     * @return RedirectResponse
     */
    public function update(DriverRequest $request, Driver $driver)
    {
        if ($this->driverService->updateData($request->all(), $driver)) {
            {
                return redirect()
                    ->route('vms.drivers.index')
                    ->with('success', trans('labels.update_success'));
            }
        } else {
            return redirect()
                ->route('vms.drivers.index')
                ->with('error', trans('labels.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
