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
use Modules\Accounts\Entities\SalaryStructure;


class SalaryStructureRepository extends AbstractBaseRepository
{
    protected $modelName = SalaryStructure::class;

    public function getStructuresByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

}
