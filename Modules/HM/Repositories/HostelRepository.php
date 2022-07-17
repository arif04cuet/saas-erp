<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/11/18
 * Time: 6:42 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\Hostel;

class HostelRepository extends AbstractBaseRepository
{
    protected $modelName = Hostel::class;

    public function getHostelsWithSelectedRooms($hostelIds, $roomIds)
    {
        return Hostel::with(['rooms' => function($query) use($roomIds) {
            $query->whereIn('id', $roomIds);
        }])->whereIn('id', $hostelIds)->get();
    }
}
