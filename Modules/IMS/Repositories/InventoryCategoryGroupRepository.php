<?php


namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryCategoryGroup;

class InventoryCategoryGroupRepository extends AbstractBaseRepository
{
    protected $modelName = InventoryCategoryGroup::class;

    public function testR()
    {
        die('testing in Repository');
    }
}
