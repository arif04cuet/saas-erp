<?php

namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\AuctionItem;

class AuctionItemRepository extends AbstractBaseRepository {

    protected $modelName = AuctionItem::class;
}
