<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 9/18/19
 * Time: 5:20 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\AppraisalSetting;

class AppraisalSettingRepository extends AbstractBaseRepository
{
    protected $modelName = AppraisalSetting::class;
}