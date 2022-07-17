<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\EconomyCodeSetting;

class EconomyCodeSettingRepository extends AbstractBaseRepository {

    protected $modelName = EconomyCodeSetting::class;

}
