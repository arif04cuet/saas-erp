<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/28/18
 * Time: 12:38 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\RoomInventory;

class RoomInventoryRepository extends AbstractBaseRepository
{
    protected $modelName = RoomInventory::class;
}