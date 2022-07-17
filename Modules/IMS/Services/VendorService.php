<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 5/21/19
 * Time: 12:44 PM
 */

namespace Modules\IMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\IMS\Entities\Vendor;
use Modules\IMS\Repositories\VendorRepository;

class VendorService
{
    use CrudTrait;

    /**
     * @var VendorRepository
     */
    private $vendorRepository;

    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
        $this->setActionRepository($vendorRepository);
    }

    public function getDropdownOptions()
    {
        return $this->findAll()->pluck('name', 'id');
    }
}