<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 8/1/19
 * Time: 12:54 PM
 */

namespace Modules\Accounts\Http\Controllers\Payroll;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\ContributionRegister;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Http\Requests\CreateSalaryRuleRequest;
use Modules\Accounts\Http\Requests\UpdateSalaryRuleRequest;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\EconomyHeadService;
use Modules\Accounts\Services\SalaryRuleService;

class SalaryRuleController extends Controller
{
    private $economyCodeService;
    private $salaryRuleService;
    /**
     * SalaryRuleController constructor.
     * @param EconomyHeadService $economyHeadService
     */
    public function __construct(EconomyCodeService $economyCodeService, SalaryRuleService $salaryRuleService)
    {
        $this->economyCodeService = $economyCodeService;
        $this->salaryRuleService = $salaryRuleService;
    }

    public function index()
    {
        $salaryRules = $this->salaryRuleService->findAll();
        return view('accounts::payroll.salary-rule.index',compact('salaryRules'));
    }

    public function create()
    {
        $salaryCategories = SalaryCategory::pluck('name', 'id');
        $contributionRegisters = ['' => __('labels.select')] + ContributionRegister::pluck('name', 'name')->toArray();
        $economyCodeOptions = ['' => __('labels.select')] +
            $this->economyCodeService->getEconomyCodesForDropdown(null, function ($code){
                return $code->code;
            }, null, false);
        $conditions = config('constants.condition_types');
        $amountTypes = config('constants.amount_types');
        $salaryRules = $this->salaryRuleService->getRulesForDropdown();
        $salaryRulesJson = json_encode($this->salaryRuleService->getRulesForJson());
        $page = 'create';

        return view('accounts::payroll.salary-rule.create', compact('salaryCategories',
            'contributionRegisters', 'conditions', 'amountTypes','economyCodeOptions','salaryRules',
            'salaryRulesJson', 'page'));
    }

    public function store(CreateSalaryRuleRequest $request)
    {
        $this->salaryRuleService->saveData($request->all());
        Session::flash('success', __('labels.save_success'));

        return redirect(route('salary-rule.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $salaryRule = $this->salaryRuleService->findOne($id);
        $conditions = config('constants.condition_types');
        $amountTypes = config('constants.amount_types');
        return view('accounts::payroll.salary-rule.show', compact('salaryRule', 'conditions',
            'amountTypes'));
    }

    public function edit($id)
    {
        $salaryRule = $this->salaryRuleService->findOne($id);
        if(in_array($salaryRule->code, config('constants.base_salary_rule_codes')))
            return redirect()->back()->with('error', 'Base rules can not be edited');
        $salaryCategories = SalaryCategory::pluck('name', 'id');
        $contributionRegisters = ['' => __('labels.select')] + ContributionRegister::pluck('name', 'name')->toArray();
        $economyCodeOptions = ['' => __('labels.select')] +
            $this->economyCodeService->getEconomyCodesForDropdown(null, function ($code){
            return $code->code;
            }, null, false);
        $conditions = config('constants.condition_types');
        $amountTypes = config('constants.amount_types');
        $salaryRules = $this->salaryRuleService->getRulesForDropdown();
        $salaryRulesJson = json_encode($this->salaryRuleService->getRulesForJson());
        $page = 'edit';

        return view('accounts::payroll.salary-rule.create', compact('salaryRule',
            'contributionRegisters', 'salaryCategories', 'economyCodeOptions','conditions', 'amountTypes',
            'salaryRules', 'salaryRulesJson','page'));
    }

    public function update(UpdateSalaryRuleRequest $request, $id)
    {
        $this->salaryRuleService->updateData($request->all(), $id);
        return redirect(route('salary-rule.show', $id))->with('success', __('labels.update_success'));
    }

    public function destroy($id)
    {
        $this->salaryRuleService->delete($id);
        Session::flash('success', __('labels.delete_success'));

        return redirect()->back();
    }

    public function createSalaryCategory()
    {
        return view('accounts::payroll.salary-category.create');
    }

    public function storeSalaryCategory(Request $request)
    {
        $this->salaryRuleService->saveSalaryCategory($request->all());
        Session::flash('success', __('labels.save_success'));

        return redirect()->back();
    }

    public function createContributionRegister()
    {
        return view('accounts::payroll.contribution-register.create');
    }

    public function storeContributionRegister(Request $request)
    {
        $this->salaryRuleService->saveContributionRegister($request->all());
        return redirect()->back()->with('success', __('labels.save_success'));
    }
}
