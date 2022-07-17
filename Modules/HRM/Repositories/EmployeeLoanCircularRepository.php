<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Modules\HRM\Entities\EmployeeLoanCircular;

class EmployeeLoanCircularRepository extends AbstractBaseRepository {

    protected $modelName = EmployeeLoanCircular::class;

    public function getActiveCirculars()
    {
        return $this->model->where('status', 'active')->where('last_date_of_application', '>=', Carbon::now())->get();
    }
}
