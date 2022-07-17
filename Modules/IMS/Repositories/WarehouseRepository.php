<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 4/28/19
 * Time: 11:53 AM
 */

namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\Warehouse;

class WarehouseRepository extends AbstractBaseRepository
{
    protected $modelName = Warehouse::class;
}