<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 7/30/19
 * Time: 7:15 PM
 */

namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\AppraisalContent;

class AppraisalContentRepository extends AbstractBaseRepository
{
    protected $modelName = AppraisalContent::class;
}