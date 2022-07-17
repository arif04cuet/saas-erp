<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 5/15/19
 * Time: 3:27 PM
 */

namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryItemCategory;

class InventoryItemCategoryRepository extends AbstractBaseRepository
{
    protected $modelName = InventoryItemCategory::class;
}