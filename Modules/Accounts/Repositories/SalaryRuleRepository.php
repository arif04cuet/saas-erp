<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 10/10/18
 * Time: 12:10 PM
 */

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Entities\SalaryRule;

class SalaryRuleRepository extends AbstractBaseRepository
{
    protected $modelName = SalaryRule::class;

    public function getGpfRules()
    {
        return $this->model->whereIn('code', ['GPFC', 'GPFA'])->get();
    }

    public function getRuleByCodes(array $codes)
    {
        return $this->model->whereIn('code', $codes)->get();
    }

}