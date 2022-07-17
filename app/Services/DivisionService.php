<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 2/24/19
 * Time: 5:20 PM
 */

namespace App\Services;


use App\Repositories\DivisionRepository;
use App\Traits\CrudTrait;

class DivisionService
{
    use CrudTrait;

    /**
     * DivisionService constructor.
     */
    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->setActionRepository($divisionRepository);
    }
}