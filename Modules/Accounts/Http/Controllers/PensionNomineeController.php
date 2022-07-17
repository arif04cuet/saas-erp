<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Services\PensionNomineeService;
use Modules\HRM\Services\EmployeeService;

class PensionNomineeController extends Controller
{
    /**
     * @var PensionNomineeService
     */
    private $pensionNomineeService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * PensionNomineeController constructor.
     * @param PensionNomineeService $pensionNomineeService
     * @param EmployeeService $employeeService
     */
    public function __construct(PensionNomineeService $pensionNomineeService, EmployeeService $employeeService)
    {
        $this->pensionNomineeService = $pensionNomineeService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nominees = $this->pensionNomineeService->findAll();
        return view('accounts::pension-nominee.index', compact('nominees'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employees = $this->employeeService->getEmployeesForDropdown();
        $page = 'create';
        return view('accounts::pension-nominee.create', compact('employees', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->pensionNomineeService->savePensionNominees($request->all());
        return redirect()->route('pension-nominees.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $nominee = $this->pensionNomineeService->findOne($id);
        return view('accounts::pension-nominee.show', compact('nominee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $nominee = $this->pensionNomineeService->findOne($id);
        $page = 'edit';
        return view('accounts::pension-nominee.create', compact('nominee', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $update = $this->pensionNomineeService->updatePensionNominees($request->all(), $id);
        return redirect()->route('pension-nominees.index');
    }

    /**
     * Returns Json of Nominees
     * @param $employeeId
     * @return false|string
     */
    public function getNomineesJosn($employeeId)
    {
        return json_encode($this->pensionNomineeService->getNomineesForDropdown($employeeId));

    }
}
