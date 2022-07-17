<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\RawMaterial;

class RawMaterialRepository extends AbstractBaseRepository 
{

    protected $modelName = RawMaterial::class;

}
