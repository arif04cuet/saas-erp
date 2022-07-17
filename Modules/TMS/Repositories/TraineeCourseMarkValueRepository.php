<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/21/19
 * Time: 5:06 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TraineeCourseMarkValue;

class TraineeCourseMarkValueRepository extends AbstractBaseRepository
{
    protected $modelName = TraineeCourseMarkValue::class;
}