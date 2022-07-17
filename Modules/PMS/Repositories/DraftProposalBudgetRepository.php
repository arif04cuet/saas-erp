<?php
/**
 * Created by PhpStorm.
 * User: Tanvir
 * Date: 2/4/19
 * Time: 3:35 PM
 */

namespace Modules\PMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\DraftProposalBudget;

class DraftProposalBudgetRepository extends AbstractBaseRepository
{
    protected $modelName = DraftProposalBudget::class;
}