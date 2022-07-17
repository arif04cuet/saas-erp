<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 2/24/19
 * Time: 5:20 PM
 */

namespace App\Repositories;


use App\Entities\Division;

class DivisionRepository extends AbstractBaseRepository
{
    protected $modelName = Division::class;
}