<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 10/21/18
 * Time: 3:17 PM
 */

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Cassandra\Collection;
use Illuminate\Support\Facades\App;
use Modules\Accounts\Entities\EmployeeContractAssignedRule;
use Modules\Accounts\Entities\SalaryBasic;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Entities\SalaryRule;
use Modules\Accounts\Entities\SalaryStructure;
use Modules\Accounts\Entities\SalaryStructureRule;
use Modules\Accounts\Repositories\SalaryStructureRepository;

class SalaryStructureService
{
    use CrudTrait;

    protected $salaryStructureRepository;

    /**
     * @var SalaryRuleService
     */
    private $salaryRuleService;

    /**
     * SalaryStructureService constructor.
     * @param SalaryStructureRepository $salaryStructureRepository
     * @param SalaryRuleService $salaryRuleService
     */
    public function __construct(
        SalaryStructureRepository $salaryStructureRepository,
        SalaryRuleService $salaryRuleService
    ) {
        $this->salaryStructureRepository = $salaryStructureRepository;
        $this->salaryRuleService = $salaryRuleService;
        $this->setActionRepository($salaryStructureRepository);
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */

    public function saveData($data)
    {
        $savedItem = $this->save($data);
        foreach ($data['salary_rules'] as $salary_rule) {
            $salaryStructureRule = new SalaryStructureRule;
            $salaryStructureRule->salary_structure_id = $savedItem->id;
            $salaryStructureRule->salary_rule_id = $salary_rule;
            $salaryStructureRule->save();
        }
        return $savedItem;
    }

    /**
     * @param $data
     * @param $id
     */
    public function updateData($data, $id)
    {
        $salaryStructure = $this->findOne($id);
        $salaryRules = (!is_null($salaryStructure)) ? $salaryStructure->rules->pluck('id')->toArray() : [];
        $data['is_parent'] = (isset($data['is_parent'])) ? 1 : null;
        $newRules = array_diff($data['salary_rules'], $salaryRules);
        $toBeDeletedRules = array_diff($salaryRules, $data['salary_rules']);
        $this->update($salaryStructure, $data);
        foreach ($newRules as $newRule) {
            $salaryStructureRule = new SalaryStructureRule;
            $salaryStructureRule->salary_structure_id = $id;
            $salaryStructureRule->salary_rule_id = $newRule;
            $salaryStructureRule->save();
        }
        foreach ($toBeDeletedRules as $toBeDeletedRule) {
            SalaryStructureRule::where('salary_structure_id', $id)
                ->where('salary_rule_id', $toBeDeletedRule)
                ->delete();
        }

    }

    public function getStructureForDropdown()
    {
        return $this->findBy(['is_parent' => null])->pluck('name', 'id');
    }

    public function getParentStructuresForDropdown()
    {
        return $this->findBy(['is_parent' => 1])->pluck('name', 'id');
    }

    public function getBonusStructuresForDropdown()
    {
        return $this->getAllBonusStructures()->pluck('name', 'id');
    }

    public function getBaseStructure()
    {
        return $this->findBy(['is_parent' => 1, 'reference' => 'Base'])->first();
    }

    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getSalaryStructuresForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $salaryStructures = $query ? $this->salaryStructureRepository->findBy($query) : $this->salaryStructureRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $salaryStructures,
            $implementedKey,
            $implementedValue ?: function ($salaryStructure) {
                return $salaryStructure->name;
            },
            $isEmptyOption
        );
    }


    public function getContractAssignedRules($id, $employeeContractId = null)
    {
        $structure = $this->findOne($id);
        $assignRules = $structure->rules->where('amount_type', 3);
        $parent = ($structure) ? $structure->parent : null;
        $assignRulesParent = [];
        $data = [];
        if (!is_null($parent)) {
            $assignRulesParent = $parent->rules->where('amount_type', 3);
        }
        $assignRules = $assignRules->merge($assignRulesParent)->sortBy('sequence');
        foreach ($assignRules as $assignRule) {
            $contractAssignedRule = (!is_null($employeeContractId)) ?
                EmployeeContractAssignedRule::where('employee_contract_id', $employeeContractId)
                    ->where('salary_rule_id', $assignRule->id)
                    ->first() : null;
            $data[] = [
                'name' => (App::getLocale() == 'bn') ? $assignRule->bangla_name : $assignRule->name,
                'rule_id' => $assignRule->id,
                'code' => $assignRule->code,
                'salary_category' => $assignRule->salaryCategory->name,
                'value' => (!is_null($contractAssignedRule)) ? ($contractAssignedRule->amount) ?? '' : '',
                'remark' => (!is_null($contractAssignedRule)) ? ($contractAssignedRule->remark) ?? '' : '',
                'assigned_rule_id' => (!is_null($contractAssignedRule)) ?
                    $contractAssignedRule->id : 0
            ];
        }
        return $data;
    }

    /**
     * Get SalaryStructures Of Bonus Codes
     * @return mixed
     */
    public function getAllBonusStructures()
    {
        $rules = $this->salaryRuleService
            ->getBonusRules();
        $structureIds = $rules->each(function ($r) {
            $r->salary_structure_id = $r->salaryStructures->first()->id;
        })->pluck('salary_structure_id')->toArray();
        $salaryStructures = $this->actionRepository->getStructuresByIds($structureIds);
        return $salaryStructures;
    }

}
