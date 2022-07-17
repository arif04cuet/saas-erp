<?php
/**
 * Created by PhpStorm.
 * User: bs100
 * Date: 1/28/19
 * Time: 7:19 PM
 */

namespace App\Services\workflow;


use App\Repositories\workflow\FeatureRepository;
use App\Traits\CrudTrait;

class FeatureService
{
    use CrudTrait;
    private $featureRepository;

    public function __construct(FeatureRepository $featureRepository)
    {
        $this->featureRepository = $featureRepository;
        $this->setActionRepository($this->featureRepository);

    }


}