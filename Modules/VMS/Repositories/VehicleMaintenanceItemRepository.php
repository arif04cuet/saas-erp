<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\VMS\Entities\VehicleMaintenanceItem;

class VehicleMaintenanceItemRepository extends AbstractBaseRepository {

    protected $modelName = VehicleMaintenanceItem::class;

}
