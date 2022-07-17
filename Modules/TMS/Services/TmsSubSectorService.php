<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Modules\TMS\Repositories\TmsSubSectorRepository;

class TmsSubSectorService
{
    use CrudTrait;

    public function __construct(TmsSubSectorRepository $tmsSubSectorRepository)
    {
        $this->setActionRepository($tmsSubSectorRepository);
    }


    public function getTmsSubSectorsForDropdown()
    {
        $TmsSubSectors = $this->actionRepository->findAll();

        if (app()->isLocale('en')) {
            return $TmsSubSectors->pluck('title_english', 'id');
        } else {
            return $TmsSubSectors->pluck('title_bangla', 'id');
        }
    }


}

