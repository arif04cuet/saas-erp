<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PMS\Entities\Project;
use Modules\PMS\Services\ProjectAttributePlannedValueService;
use Illuminate\Support\Facades\Session;

class ProjectAttributePlannedValueController extends Controller
{


    private $projectAttributePlannedValueService;

    public function __construct(
        ProjectAttributePlannedValueService $projectAttributePlannedValueService
    ) {
        $this->projectAttributePlannedValueService = $projectAttributePlannedValueService;
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
        return view('pms::project.attribute-planned.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Project $project)
    {
        if ($this->projectAttributePlannedValueService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('project.show', $project->id);
    }
}
