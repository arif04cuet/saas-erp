<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\PublicationPressService;
use Modules\HRM\Services\EmployeeService;
use Modules\Publication\Http\Requests\PublicationPressRequest;

class PublicationPressController extends Controller
{
    private $publicationPressService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * PublicationPressContractController constructor.
     * @param EmployeeService $employeeService
     */
    public function __construct(
        PublicationPressService $publicationPressService,
        EmployeeService $employeeService
    ) {
        $this->publicationPressService = $publicationPressService;
        $this->employeeService = $employeeService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $presses = $this->publicationPressService->findAll();

        return view('publication::publication-press.index', compact('presses'));
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
        return view('publication::publication-press.create', compact('page', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PublicationPressRequest $request
     * @return Response
     */
    public function store(PublicationPressRequest $request)
    {
        $this->publicationPressService->save($request->all());
        return redirect()->route('publication-presses.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect()->route('publication-presses.index');
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
        $presses = $this->publicationPressService->findOrFail($id);
        return view('publication::publication-press.create', compact('presses', 'page', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     * @param PublicationPressRequest $request
     * @param int $id
     * @return Response
     */
    public function update(PublicationPressRequest $request, $id)
    {
        $this->publicationPressService->findOrFail($id)->update($request->all());
        return redirect()->route('publication-presses.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->publicationPressService->delete($id);
        return redirect()->route('publication-presses.index')->with('success', "Deleted Successfully");
    }
}
