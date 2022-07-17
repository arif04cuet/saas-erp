<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 5/16/19
 * Time: 4:31 PM
 */

namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryLocation;

class InventoryLocationRepository extends AbstractBaseRepository
{
    protected $modelName = InventoryLocation::class;
}
