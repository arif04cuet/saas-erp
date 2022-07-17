<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 5/21/19
 * Time: 1:47 PM
 */

namespace Modules\IMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\AuctionSale;

class AuctionSaleRepository extends AbstractBaseRepository
{
    protected $modelName = AuctionSale::class;
}