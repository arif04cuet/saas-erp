<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 5/21/19
 * Time: 12:44 PM
 */

namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\Vendor;

class VendorRepository extends AbstractBaseRepository
{
    protected $modelName = Vendor::class;
}