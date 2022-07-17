<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Entities\GpfConfiguration;
use Modules\Accounts\Repositories\GpfConfigurationRepository;

class GpfConfigurationService
{
    use CrudTrait;

    private $gpfConfigurationRepository;

    /**
     * GpfConfigurationService constructor.
     * @param GpfConfigurationRepository $gpfConfigurationRepository
     */
    public function __construct(GpfConfigurationRepository $gpfConfigurationRepository)
    {
        $this->gpfConfigurationRepository = $gpfConfigurationRepository;

        $this->setActionRepository($gpfConfigurationRepository);
    }

    /**
     * Storing and activating new configuration after deactivating the existing by setting status to 0
     * @param $data
     */
    public function saveData($data)
    {
        DB::transaction(function () use ($data) {
            $existingConfigurations = $this->findAll();
            if (count($existingConfigurations)) {
                GpfConfiguration::where('id', '!=', 0)->update(['status' => 0]);
            }
            $data['status'] = 1;
            $save = $this->save($data);
            return $save;
        });
    }

    /**
     * @param array $data
     * @param $id
     */
    public function updateData(array $data, $id)
    {
        $configuration = $this->findOrFail($id);
        $this->update($configuration, $data);
    }

    public function toggleActivation($id)
    {
        $configuration = $this->findOrFail($id);
        if ($configuration->status) {
            $this->update($configuration, ['status' => 0]);
        } else {
            GpfConfiguration::where('id', '!=', 0)->update(['status' => 0]);
            $this->update($configuration, ['status' => 1]);
        }


    }
    public function getActiveConfiguration()
    {
        return $this->findBy(['status' => 1])->first();
    }
}

