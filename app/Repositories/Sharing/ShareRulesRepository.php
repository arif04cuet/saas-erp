<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 3/4/19
 * Time: 12:05 PM
 */

namespace App\Repositories\Sharing;


use App\Entities\Sharing\ShareRule;
use App\Repositories\AbstractBaseRepository;

class ShareRulesRepository extends AbstractBaseRepository
{
    protected $modelName = ShareRule::class;

}