<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 7/29/19
 * Time: 3:29 PM
 */
namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\Appraisal;

class AppraisalRepository extends  AbstractBaseRepository {
    protected $modelName = Appraisal::class;
}