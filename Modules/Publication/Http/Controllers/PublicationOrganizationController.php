<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\PublicationOrganizationService;
use Modules\HRM\Services\EmployeeService;
use Modules\Publication\Http\Requests\PublicationOrganizationRequest;

class PublicationOrganizationController extends Controller
{

    private $publicationOrganizationService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * PublicationPressContractController constructor.
     * @param EmployeeService $employeeService
     */
    public function __construct(
        PublicationOrganizationService $publicationOrganizationService,
        EmployeeService $employeeService
    ) {
        $this->publicationOrganizationService = $publicationOrganizationService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $organizations = $this->publicationOrganizationService->findAll();
        return view('publication::publication-organization.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employees = $this->employeeService->getEmployeesForDropdown(
            null,
            null,
            null,
            true
        );
        $page = "create";
        return view('publication::publication-organization.create', compact('page', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PublicationOrganizationRequest $request
     * @return Response
     */
    public function store(PublicationOrganizationRequest $request)
    {
        $this->publicationOrganizationService->save($request->all());
        return redirect()->route('publication-organizations.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('publication::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $employees = $this->employeeService->getEmployeesForDropdown(
            null,
            null,
            null,
            true
        );
        $page = "edit";
        $organizations = $this->publicationOrganizationService->findOrFail($id);
        return view('publication::publication-organization.create', compact('organizations', 'page', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     * @param PublicationOrganizationRequest $request
     * @param int $id
     * @return Response
     */
    public function update(PublicationOrganizationRequest $request, $id)
    {
        $this->publicationOrganizationService->findOrFail($id)->update($request->all());
        return redirect()->route('publication-organizations.index')->with('success', __('labels.update_success'));
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
