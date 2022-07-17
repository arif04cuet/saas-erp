<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 3/4/19
 * Time: 12:08 PM
 */

namespace App\Services\Sharing;


use App\Repositories\Sharing\ShareRulesRepository;
use App\Traits\CrudTrait;

class ShareRulesService
{
    use CrudTrait;
    private $shareRuleRepository;

    public function __construct(ShareRulesRepository $rulesRepository)
    {
        $this->shareRuleRepository = $rulesRepository;
        $this->setActionRepository($this->shareRuleRepository);
    }

}