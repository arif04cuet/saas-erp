<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/28/18
 * Time: 12:36 PM
 */

namespace Modules\HM\Services;


use App\Traits\CrudTrait;
use Modules\HM\Repositories\RoomInventoryRepository;

class RoomInventoryService
{
    use CrudTrait;

    /**
     * @var RoomInventoryRepository
     */
    private $roomInventoryRepository;


    /**
     * RoomInventoryService constructor.
     * @param RoomInventoryRepository $roomInventoryRepository
     */
    public function __construct(RoomInventoryRepository $roomInventoryRepository)
    {
        $this->roomInventoryRepository = $roomInventoryRepository;
        $this->setActionRepository($roomInventoryRepository);
    }
}