<?php
/**
 * Created by Imran Hossain - 25-05-19.
 */

namespace Modules\IMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\Auction;

class AuctionRepository extends AbstractBaseRepository
{
    protected $modelName = Auction::class;
}