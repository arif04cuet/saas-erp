<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\CafeteriaInventoryTransactionRepository;

class CafeteriaInventoryTransactionService
{
    use CrudTrait;

    private $cafeteriaInventoryTransactionRepository;

    public function __construct(
        CafeteriaInventoryTransactionRepository $cafeteriaInventoryTransactionRepository
    ) {
        $this->cafeteriaInventoryTransactionRepository = $cafeteriaInventoryTransactionRepository;
        $this->setActionRepository($this->cafeteriaInventoryTransactionRepository);
    }
}

