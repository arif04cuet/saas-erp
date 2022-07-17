<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\UnitPriceRepository;

class UnitPriceService
{
    use CrudTrait;

    private $unitPriceRepository;

    public function __construct(UnitPriceRepository $unitPriceRepository)
    {
        $this->unitPriceRepository = $unitPriceRepository;
        $this->setActionRepository($this->unitPriceRepository);
    }
}

