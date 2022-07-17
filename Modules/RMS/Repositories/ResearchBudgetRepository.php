<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 1/24/19
 * Time: 6:48 PM
 */

namespace Modules\RMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\RMS\Entities\ResearchBudget;

class ResearchBudgetRepository extends  AbstractBaseRepository
{
    protected $modelName = ResearchBudget::class;
}