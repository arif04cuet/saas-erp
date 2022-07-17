<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TmsSubSector;

class TmsSubSectorRepository extends AbstractBaseRepository
{
    protected $modelName = TmsSubSector::class;

    public function deleteBySectorIdExceptSubSectors(int $sectorId, array $subSectorIds)
    {
        return $this->model->where('tms_sector_id', $sectorId)->whereNotIn('id', $subSectorIds)->delete();
    }
}
