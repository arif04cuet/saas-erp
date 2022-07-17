<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 3/19/19
 * Time: 4:40 PM
 */

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Modules\TMS\Repositories\TraineeDiseaseRepository;

class TraineeDiseaseService
{
    use CrudTrait;

    /**
     * @var TraineeDiseaseRepository
     */
    private $traineeDiseaseRepository;

    public function __construct(TraineeDiseaseRepository $traineeDiseaseRepository)
    {
        $this->traineeDiseaseRepository = $traineeDiseaseRepository;
        $this->setActionRepository($traineeDiseaseRepository);
    }

}