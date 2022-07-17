<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/21/19
 * Time: 5:23 PM
 */

namespace App\Repositories\workflow;


use App\Entities\workflow\Feature;
use App\Repositories\AbstractBaseRepository;

class FeatureRepository extends AbstractBaseRepository
{
    protected $modelName = Feature::class;
}
