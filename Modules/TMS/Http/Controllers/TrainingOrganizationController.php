<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\TrainingOrganization;
use Modules\TMS\Http\Requests\StoreUpdateTrainingOrganizationRequest;
use Modules\TMS\Services\TrainingOrganizationService;

class TrainingOrganizationController extends Controller
{

    /**
     * @var TrainingOrganizationService
     */
    private $trainingOrganizationService;

    public function __construct(TrainingOrganizationService $trainingOrganizationService)
    {
        /** @var TrainingOrganizationService $trainingOrganizationService */
        $this->trainingOrganizationService = $trainingOrganizationService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $trainingOrganizations = $this->trainingOrganizationService->findAll()->sortByDesc(function ($organization){
            return $organization->created_at;
        });
        return view('tms::organization.index', compact('trainingOrganizations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $organizationId = $this->trainingOrganizationService->generateOrganizationId();
        return view('tms::organization.create', compact('organizationId'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreUpdateTrainingOrganizationRequest $request)
    {
        $trainingOrganization = $this->trainingOrganizationService->storeTrainingOrganization($request->all());

        if ($trainingOrganization) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('organization.index');
    }

    /**
     * Show the specified resource.
     * @param TrainingOrganization $trainingOrganization
     * @return Response
     */
    public function show(TrainingOrganization $trainingOrganization)
    {
        return view('tms::organization.show', compact('trainingOrganization'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param TrainingOrganization $trainingOrganization
     * @return Response
     */
    public function edit(TrainingOrganization $trainingOrganization)
    {
        return view('tms::organization.edit', compact('trainingOrganization'));
    }

    /**
     * Update the specified resource in storage.
     * @param StoreUpdateTrainingOrganizationRequest $request
     * @param TrainingOrganization $trainingOrganization
     * @return void
     */
    public function update(StoreUpdateTrainingOrganizationRequest $request, TrainingOrganization $trainingOrganization)
    {
        $trainingOrganization = $this->trainingOrganizationService->updateTrainingOrganization($trainingOrganization, $request->all());

        if ($trainingOrganization) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('organization.index');
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
