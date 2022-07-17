<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PMS\Entities\Project;
use Modules\PMS\Services\ProjectAttributeAchievedValueService;
use Illuminate\Support\Facades\Session;

class ProjectAttributeAchievedValueController extends Controller
{

    private $projectAttributeAchievedValueService;

    public function __construct(
        ProjectAttributeAchievedValueService $projectAttributeAchievedValueService
    ) {
        $this->projectAttributeAchievedValueService = $projectAttributeAchievedValueService;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('pms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Project $project)
    {
        return view('pms::project.attribute-achieved.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Project $project)
    {
        if ($this->projectAttributeAchievedValueService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('project.show', $project->id);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('pms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('pms::edit');
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
