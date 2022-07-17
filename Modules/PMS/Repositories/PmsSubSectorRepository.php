<?php


namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\PmsSubSector;

class PmsSubSectorRepository extends AbstractBaseRepository
{
    protected $modelName = PmsSubSector::class;

    public function deleteBySectorIdExceptSubSectors(int $sectorId, array $subSectorIds)
    {
        return $this->model->where('pms_sector_id', $sectorId)->whereNotIn('id', $subSectorIds)->delete();
    }
}
