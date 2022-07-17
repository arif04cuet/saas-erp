<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 7/31/19
 * Time: 4:43 PM
 */

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Repositories\TrainingOrganizationRepository;

class TrainingOrganizationService
{
    use CrudTrait;

    /**
     * @var TrainingOrganizationRepository
     */
    private $trainingOrganizationRepository;

    public function __construct(TrainingOrganizationRepository $trainingOrganizationRepository)
    {
        /** @var TrainingOrganizationRepository $trainingOrganizationRepository */
        $this->trainingOrganizationRepository = $trainingOrganizationRepository;
        $this->setActionRepository($trainingOrganizationRepository);
    }

    public function generateOrganizationId()
    {
        $prefix = 'BARD-TRN-ORG-';
        $id = date('Y-m-s').rand(9999, 100000);
        $organizationId = $prefix.$id;
        return $organizationId;
    }

    public function storeTrainingOrganization(array $data)
    {
        return DB::transaction(function () use ($data){
            return $this->save($data);
        });
    }

    public function updateTrainingOrganization($trainingOrganization, array $data)
    {
        return DB::transaction(function () use ($trainingOrganization, $data) {
            return $this->update($trainingOrganization, $data);
        });
    }

    public function getTrainingOrganizationsForDropdown()
    {
        return $this->trainingOrganizationRepository->findAll()->mapWithKeys(function ($organization){
            return [$organization->id => $organization->name];
        });
    }

}
