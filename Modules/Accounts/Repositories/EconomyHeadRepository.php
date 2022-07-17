<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/10/18
 * Time: 12:10 PM
 */

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Constants\EconomyConstant;
use Modules\Accounts\Entities\EconomyHead;

class EconomyHeadRepository extends AbstractBaseRepository
{
    protected $modelName = EconomyHead::class;

    public function getMainParentHeads()
    {
        return $this->findBy(['parent_id' => EconomyConstant::PARENT]);
    }

    public function getHeadByCodeAndLevel($economyCode, $level)
    {
        $economyHeadCode = substr($economyCode, 0, $level);
        return $this->model->where('code', $economyHeadCode)->first();
    }
}