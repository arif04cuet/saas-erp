<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 1/3/19
 * Time: 5:34 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\CheckinPayment;

class CheckinPaymentRepository extends AbstractBaseRepository
{
    protected $modelName = CheckinPayment::class;
}