<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 08/04/19
 * Time: 15:29
 */

namespace App\Repositories\Sharing;


use App\Entities\Sharing\ShareRuleDesignation;
use App\Repositories\AbstractBaseRepository;

class ShareRuleDesignationRepository extends AbstractBaseRepository
{
    protected $modelName = ShareRuleDesignation::class;

    public function getShareRuleDesignationByRuleAndDesignation($shareRuleId, $designationId)
    {
        $shareRuleDesignation = ShareRuleDesignation::whereShareRuleId($shareRuleId)->whereDesignationId($designationId)->first();
        return $shareRuleDesignation;
    }
}