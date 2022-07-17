<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 03/04/19
 * Time: 16:30
 */

namespace Modules\RMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\RMS\Entities\ResearchDetailSubmission;


class ResearchDetailSubmissionRepository extends AbstractBaseRepository
{

    protected $modelName = ResearchDetailSubmission::class;

}