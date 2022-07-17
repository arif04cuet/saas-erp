<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PMS\Entities\Project;
use Modules\PMS\Services\ProjectAttributeService;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\ProjectAttribute;

class ProjectAttributeController extends Controller
{

    private $projectAttributeService;

    public function __construct(
        ProjectAttributeService $projectAttributeService
    ) {
        $this->projectAttributeService = $projectAttributeService;
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
        return view('pms::project.attribute.create', compact(['project']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->projectAttributeService->save($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->back();
    }

    public function graphValues(Project $project, ProjectAttribute $attribute)
    {
        return response()->json([
            'name' => $attribute->name,
            'attributeValues' => $this->projectAttributeService->getAchievedPlannedValuesByMonthYear($attribute, true)
        ], 200);
    }

    public function filter(Request $request, $projectId)
    {
        if (!is_null($request['project_attribute_id'])) {
            return $value = $this->projectAttributeService->filterUsingProjectAttribute(
                $request['project_attribute_id'],
                $request['period_from'],
                $request['period_to']
            );
        } else {

            $value = $this->projectAttributeService->filterAttributeValuesByDateRange(
                $projectId,
                $request['period_from'],
                $request['period_to']
            );
            $selectedProjectId = 0;
            $values = [];
            array_push($values, $value);
            array_push($values,  $selectedProjectId);
            return  $values;
        }
    }
}
