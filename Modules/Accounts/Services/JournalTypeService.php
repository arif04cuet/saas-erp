<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Modules\Accounts\Repositories\JournalRepository;
use Modules\Accounts\Repositories\JournalTypeRepository;

class JournalTypeService
{
    use CrudTrait;

    protected $journalTypeRepository;

    /**
     * JournalTypeService constructor.
     * @param JournalTypeRepository $journalTypeRepository
     */
    public function __construct(JournalTypeRepository $journalTypeRepository)
    {
        $this->journalTypeRepository = $journalTypeRepository;
        $this->setActionRepository($this->journalTypeRepository);
    }

}

