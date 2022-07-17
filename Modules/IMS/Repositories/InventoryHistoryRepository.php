<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 5/20/19
 * Time: 9:40 AM
 */

namespace Modules\IMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryHistory;

class InventoryHistoryRepository extends AbstractBaseRepository
{
    protected $modelName = InventoryHistory::class;

}