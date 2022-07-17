<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\SpecialGroupBillListRepository;

class SpecialGroupBillListService
{

    use CrudTrait;

    /**
     * @var $specialGroupBillListRepository
    */

    private $specialGroupBillListRepository;

    /**
     * @param SpecialGroupBillListRepository $specialGroupBillListRepository
    */


    public function __construct(SpecialGroupBillListRepository $specialGroupBillListRepository)
    {
        $this->specialGroupBillListRepository = $specialGroupBillListRepository;
        $this->setActionRepository($this->specialGroupBillListRepository);
    }

}

