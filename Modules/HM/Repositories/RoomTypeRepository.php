<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/9/18
 * Time: 5:08 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\RoomType;

class RoomTypeRepository extends AbstractBaseRepository
{
    protected $modelName = RoomType::class;

    public function pluck()
    {
        return RoomType::pluck('name', 'id');
    }
}
