<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 3/19/19
 * Time: 4:44 PM
 */

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TraineeDisease;


class TraineeDiseaseRepository extends AbstractBaseRepository
{
    protected $modelName = TraineeDisease::class;

}