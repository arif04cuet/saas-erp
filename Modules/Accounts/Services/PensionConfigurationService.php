<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\PensionConfiguration;
use Modules\Accounts\Repositories\PensionConfigurationRepository;

class PensionConfigurationService
{
    use CrudTrait;
    private $service;


    /**
     * PensionConfigurationService constructor.
     * @param PensionConfigurationRepository $pensionConfigurationRepository
     */
    public function __construct(
        PensionConfigurationRepository $pensionConfigurationRepository
    )
    {
        $this->setActionRepository($pensionConfigurationRepository);
    }

    /**
     * @return mixed
     */
    public function getActiveConfiguration()
    {
        return $this->actionRepository->getModel()->where('status', 'active')->first();
    }

    /**
     * @return Model|mixed|null
     */
    public function deactivateOtherStatus()
    {
        $activeConfiguration = $this->getActiveConfiguration();
        if ($activeConfiguration) {
            // make it inactive
            return $activeConfiguration->update(['status' => PensionConfiguration::status[1]]);
        } else {
            return null;
        }
    }

    /**
     * @param PensionConfiguration $pensionConfiguration
     * @return Model|mixed
     */
    public function changeStatus(PensionConfiguration $pensionConfiguration)
    {
        $this->deactivateOtherStatus();
        if ($pensionConfiguration->status == PensionConfiguration::status[0]) {
            $this->actionRepository->update($pensionConfiguration, ['status' => PensionConfiguration::status[1]]);
        } else {
            $this->actionRepository->update($pensionConfiguration, ['status' => PensionConfiguration::status[0]]);
        }
        return $pensionConfiguration;
    }
}

