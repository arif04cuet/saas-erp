<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 12/9/2018
 * Time: 12:41 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\HostelBudget;

class HostelBudgetRepository extends AbstractBaseRepository
{
    protected $modelName = HostelBudget::class;

    /**
     * @param $hostelBudgetTitleId
     * @return mixed
     */
    public function getHostelBudgetByTitle($hostelBudgetTitleId)
    {
        return $this->model->newQuery()
            ->whereHostelBudgetTitleId($hostelBudgetTitleId)
            ->get();
    }

}
