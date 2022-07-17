<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/9/19
 * Time: 4:38 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCafeteria;

class TrainingCafeteriaRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCafeteria::class;
}