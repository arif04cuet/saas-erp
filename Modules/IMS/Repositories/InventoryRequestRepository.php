<?php
/**
 * Created by PhpStorm.
 * User: Tanvir
 * Date: 5/20/19
 * Time: 9:40 AM
 */

namespace Modules\IMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryRequest;

class InventoryRequestRepository extends AbstractBaseRepository
{
    protected $modelName = InventoryRequest::class;
}