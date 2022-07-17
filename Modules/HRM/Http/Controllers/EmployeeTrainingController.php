<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreEmployeeTrainingRequest;
use Modules\HRM\Http\Requests\UpdateEmployeeTrainingRequest;
use Modules\HRM\Services\EmployeeTrainingService;

class EmployeeTrainingController extends Controller
{
    protected $employeeTrainingService;

    public function __construct(EmployeeTrainingService $employeeTrainingService)
    {
        $this->employeeTrainingService = $employeeTrainingService;
    }

    public function store(StoreEmployeeTrainingRequest $request)
    {

        $trainingInfo = $request->training;
        $response = $this->employeeTrainingService->StoreTrainingInfo($trainingInfo);
        Session::flash('message', $response->getContent());

        return redirect()->route( 'employee.create', ['employee' => $response->getId(), '/#others' ] );
    }

    public function update(UpdateEmployeeTrainingRequest $request, $id)
    {
        $trainingInfo = $request->training;
        $response = $this->employeeTrainingService->updateTrainingInfo($trainingInfo, $id);
        Session::flash('message', $response->getContent());
        $employee_id = $response->getId() ? $response->getId() : $request->employee_id;

		return redirect()->route('employee.edit', ['employee' => $employee_id, '#others']);
    }
}
