<?php

namespace Modules\Cafeteria\Services;

use Carbon\Carbon;
use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\VenueSelectionRepository;

class VenueSelectionService
{
    use CrudTrait;

    /**
     * @var $venueSelectionRepository
     */

    private $venueSelectionRepository;

    /**
     * @param VenueSelectionRepository $venueSelectionRepository 
    */

    public function __construct(VenueSelectionRepository $venueSelectionRepository)
    {
        $this->venueSelectionRepository = $venueSelectionRepository;
        $this->setActionRepository($this->venueSelectionRepository);
    }

    public function getDataByDateRange($request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');

        return $this->venueSelectionRepository->fetchDateRangeData($request, $todayDate);
    }
}

