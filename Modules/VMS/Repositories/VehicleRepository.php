<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\VMS\Entities\Vehicle;

class VehicleRepository extends AbstractBaseRepository
{

    protected $modelName = Vehicle::class;

    public function getVehicles(array $vehicles)
    {
        return $this->getModel()->newQuery()->whereIn('id', $vehicles)->get();
    }


}
