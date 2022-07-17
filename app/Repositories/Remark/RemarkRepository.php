<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/30/19
 * Time: 5:41 PM
 */

namespace App\Repositories\Remark;


use App\Entities\Remark\Remark;
use App\Repositories\AbstractBaseRepository;

class RemarkRepository extends AbstractBaseRepository
{
    protected $modelName = Remark::class;
}
