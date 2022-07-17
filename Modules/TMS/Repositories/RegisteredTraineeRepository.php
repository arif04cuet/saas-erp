<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 3/14/19
 * Time: 4:24 PM
 */
namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\Trainee;


class RegisteredTraineeRepository extends AbstractBaseRepository
{
    protected $modelName = Trainee::class;

}
