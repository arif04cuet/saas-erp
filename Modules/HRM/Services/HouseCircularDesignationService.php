<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Modules\HRM\Repositories\HouseCircularDesignationRepository;

class HouseCircularDesignationService
{
    use CrudTrait;

    /**
     * @var $houseCircularDesignationRepository
     */

    private $houseCircularDesignationRepository;

    /**
     * @param HouseCircularDesignationRepository $houseCircularDesignationRepository
     */

    public function __construct(HouseCircularDesignationRepository $houseCircularDesignationRepository)
    {
        $this->houseCircularDesignationRepository = $houseCircularDesignationRepository;
        $this->setActionRepository($this->houseCircularDesignationRepository);
    }

    public function deleteCircularDesignations($categoryId)
    {
        return $this->houseCircularDesignationRepository->deleteCircularDesignations($categoryId);
    }
}

