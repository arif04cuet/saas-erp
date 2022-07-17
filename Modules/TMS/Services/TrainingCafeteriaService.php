<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/9/19
 * Time: 4:38 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Modules\TMS\Repositories\TrainingCafeteriaRepository;

class TrainingCafeteriaService
{
    use CrudTrait;
    /**
     * @var TrainingCafeteriaRepository
     */
    private $cafeteriaRepository;

    /**
     * TrainingCafeteriaService constructor.
     * @param TrainingCafeteriaRepository $cafeteriaRepository
     */
    public function __construct(TrainingCafeteriaRepository $cafeteriaRepository)
    {
        $this->cafeteriaRepository = $cafeteriaRepository;
        $this->setActionRepository($cafeteriaRepository);
    }
}