<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HM\Services\CheckinPhysicalFacilityService;

class CheckinApprovedPhysicalFacilityController extends Controller
{
    /**
     * @var CheckinPhysicalFacilityService
     */
    private $checkinPhysicalFacilityService;

    public function __construct(CheckinPhysicalFacilityService $checkinPhysicalFacilityService)
    {
        $this->checkinPhysicalFacilityService = $checkinPhysicalFacilityService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hm::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->checkinPhysicalFacilityService->store($request->all())) {
            return redirect(route('check-in.index'))
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect(route('check-in.index'))
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
        return view('hm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hm::edit');
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
