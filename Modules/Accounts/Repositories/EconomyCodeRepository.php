<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/10/18
 * Time: 12:10 PM
 */

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\EconomyCode;

class EconomyCodeRepository extends AbstractBaseRepository
{
    protected $modelName = EconomyCode::class;

}