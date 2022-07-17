<?php

namespace Modules\RMS\Services;

use App\Traits\CrudTrait;
use Modules\RMS\Repositories\DateExtendRequestRepository;

class DateExtendRequestService
{
    use CrudTrait;

    private $dateExtendRequestRepository;


    public function __construct(DateExtendRequestRepository $dateExtendRequestRepository)
    {
        $this->dateExtendRequestRepository = $dateExtendRequestRepository;
        $this->setActionRepository($dateExtendRequestRepository);
    }

    public function store(array $data)
    {
        $dateExtend = $this->dateExtendRequestRepository->save($data);
        return $dateExtend;
    }

}