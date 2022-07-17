<?php
/**
 * Created by PhpStorm.
 * User: tuhin
 * Date: 10/28/18
 * Time: 6:26 PM
 */

namespace Modules\PMS\Services;


use Modules\PMS\Repositories\ProjectRequestForwardRepository;

class ProjectRequestForwardService
{
    /**
     * @var ProjectRequestForwardRepository
     */
    private $projectRequestForwardRepository;

    /**
     * ProjectRequestForwardService constructor.
     * @param ProjectRequestForwardRepository $projectRequestForwardRepository
     */
    public function __construct(ProjectRequestForwardRepository $projectRequestForwardRepository)
    {
        $this->projectRequestForwardRepository = $projectRequestForwardRepository;
    }

    public function getAll()
    {
        return $this->projectRequestForwardRepository->findAll(null, ['user', 'projectRequest'])->toArray();
    }
}