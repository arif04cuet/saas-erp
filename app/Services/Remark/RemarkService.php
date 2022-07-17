<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/30/19
 * Time: 5:42 PM
 */

namespace App\Services\Remark;


use App\Repositories\Remark\RemarkRepository;
use App\Traits\CrudTrait;

class RemarkService
{
    use CrudTrait;

    private $remarkRepository;

    /**
     * RemarkService constructor.
     * @param RemarkRepository $remarkRepository
     */
    public function __construct(RemarkRepository $remarkRepository)
    {
        $this->remarkRepository = $remarkRepository;
        $this->setActionRepository($this->remarkRepository);
    }

}
