<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Modules\HRM\Repositories\ContactRepository;

class ContactService
{
    use CrudTrait;

    /**
     * @var $contactRepository
     */

    private $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     */

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->setActionRepository($this->contactRepository);
    }
}

