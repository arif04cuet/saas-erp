<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 9/30/19
 * Time: 7:33 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCategory;

class TrainingCategoryRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCategory::class;
}