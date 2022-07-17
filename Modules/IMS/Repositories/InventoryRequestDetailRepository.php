<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 6/15/19
 * Time: 10:10 AM
 */

namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryRequestDetail;

class InventoryRequestDetailRepository extends AbstractBaseRepository
{
    protected $modelName = InventoryRequestDetail::class;
}