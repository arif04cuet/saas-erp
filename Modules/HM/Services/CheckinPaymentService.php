<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 1/3/19
 * Time: 5:34 PM
 */

namespace Modules\HM\Services;


use App\Traits\CrudTrait;
use Modules\HM\Repositories\CheckinPaymentRepository;

class CheckinPaymentService
{
    use CrudTrait;
    /**
     * @var CheckinPaymentRepository
     */
    private $checkinPaymentRepository;


    /**
     * CheckinPaymentService constructor.
     * @param CheckinPaymentRepository $checkinPaymentRepository
     */
    public function __construct(CheckinPaymentRepository $checkinPaymentRepository)
    {
        $this->checkinPaymentRepository = $checkinPaymentRepository;
        $this->setActionRepository($checkinPaymentRepository);
    }
}