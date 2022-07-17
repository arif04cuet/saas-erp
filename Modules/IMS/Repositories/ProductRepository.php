<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 5/2/19
 * Time: 3:56 PM
 */

namespace Modules\IMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\Product;

class ProductRepository extends AbstractBaseRepository{
    protected $modelName = Product::class;
}