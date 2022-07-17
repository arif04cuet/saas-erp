<?php
/**
 * Created by PhpStorm.
 * User: tuhin
 * Date: 10/18/18
 * Time: 5:24 PM
 */

namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectDetailProposal;


class ProjectDetailProposalRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectDetailProposal::class;
}
