<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\SalaryStructure;
use Modules\Accounts\Http\Requests\CreateSalaryStructureRequest;
use Modules\Accounts\Services\SalaryRuleService;
use Modules\Accounts\Services\SalaryStructureService;

class SalaryStructureController extends Controller
{
    private $salaryRuleService;
    private $salaryStructureService;

    public function __construct(SalaryRuleService $salaryRuleService, SalaryStructureService $salaryStructureService)
    {
        $this->salaryRuleService = $salaryRuleService;
        $this->salaryStructureService = $salaryStructureService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $structures = $this->salaryStructureService->findAll();
        return view('accounts::payroll.salary-structure.index', compact('structures'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $structures = ['' => __('labels.select')] +
            $this->salaryStructureService->getParentStructuresForDropdown()->toArray();
        //array_unshift($structures, [ "" => __('labels.select')]);
        $rules = $this->salaryRuleService->getRulesForDropdown();
        $salaryRules = $this->salaryRuleService->getRulesForJson();
        $salaryRulesJson = json_encode($salaryRules);
        $page = 'create';

        return view('accounts::payroll.salary-structure.create', compact('structures', 'rules',
            'salaryRulesJson', 'page'));
    }

    /**
     * @param CreateSalaryStructureRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSalaryStructureRequest $request)
    {
        //dd($request->salary_rules);
        $this->salaryStructureService->saveData($request->all());
        return redirect()->route('salary-structures.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $salaryStructure = $this->salaryStructureService->findOne($id);
        return view('accounts::payroll.salary-structure.show', compact('salaryStructure'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $structures = ['' => __('labels.select')] +
            $this->salaryStructureService->getParentStructuresForDropdown()->toArray();
        $salaryStructure = $this->salaryStructureService->findOne($id);
        $rules = $this->salaryRuleService->getRulesForDropdown();
        $salaryRules = $this->salaryRuleService->getRulesForJson();
        $salaryRulesJson = json_encode($salaryRules);
        $page = 'edit';

        return view('accounts::payroll.salary-structure.create', compact('salaryStructure',
            'rules', 'salaryRules', 'salaryRulesJson', 'structures', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CreateSalaryStructureRequest $request, $id)
    {
        $this->salaryStructureService->updateData($request->all(), $id);
        return redirect(route('salary-structures.show', $id))->with('success', __('labels.update_success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->salaryStructureService->delete($id);
        return redirect()->back()->with('success', __('labels.delete_success'));
    }

    public function getContractAssignedRules($structureId = 0, $contractId = null)
    {
        return ($structureId) ?
            json_encode($this->salaryStructureService->getContractAssignedRules($structureId, $contractId)) : [];

    }

    public function getAllRulesByStructure(SalaryStructure $salaryStructure)
    {
        return $this->salaryRuleService->getAllRules($salaryStructure);
    }
}
