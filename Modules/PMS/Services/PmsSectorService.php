<?php

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Repositories\PmsSectorRepository;
use Modules\PMS\Repositories\PmsSubSectorRepository;

class PmsSectorService
{
    use CrudTrait;

    /**
     * @var PmsSectorRepository
     */
    private $pmsSectorRepository;
    /**
     * @var PmsSubSectorRepository
     */
    private $pmsSubSectorRepository;

    /**
     * PmsSectorService constructor.
     * @param PmsSectorRepository $pmsSectorRepository
     * @param PmsSubSectorRepository $pmsSubSectorRepository
     */
    public function __construct(
        PmsSectorRepository $pmsSectorRepository,
        PmsSubSectorRepository $pmsSubSectorRepository
    ) {
        $this->pmsSectorRepository = $pmsSectorRepository;
        $this->setActionRepository($pmsSectorRepository);
        $this->pmsSubSectorRepository = $pmsSubSectorRepository;
    }

    /**
     * Method to store sector and sub-sectors
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        try {
            DB::transaction(
                function () use ($data) {
                    $saveSector = $this->save($data);

                    foreach ($data['sub_sectors'] as $sub_sector) {
                        $sub_sector['pms_sector_id'] = $saveSector->id;
                        $saveSubSector = $this->pmsSubSectorRepository->save($sub_sector);
                    }
                }
            );
            Session::flash('success', __('labels.save_success'));
            return true;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " traceback: " . $exception->getTraceAsString());
            Session::flash('error', __('labels.save_fail') . '. '
                . __('labels.error_code', ['code' => $exception->getCode()]));
            return false;
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function updateSector(array $data, $id)
    {
        try {
            DB::transaction(function () use ($data, $id) {
                $sector = $this->findOrFail($id)->update($data);

                $subSectorIds = [];
                foreach ($data['sub_sectors'] as $sub_sector) {
                    if (is_null($sub_sector['id'])) {
                        $sub_sector['pms_sector_id'] = $id;
                        $saveSubSector = $this->pmsSubSectorRepository->save($sub_sector);
                        $subSectorIds[] = $saveSubSector->id;
                    } else {
                        $subSectorIds[] = $sub_sector['id'];
                        $this->pmsSubSectorRepository->findOrFail($sub_sector['id'])->update($sub_sector);
                    }
                }
                // Deleting sub-sectors that are in DB but not in the updated sub-sector request
                $this->pmsSubSectorRepository->deleteBySectorIdExceptSubSectors($id, $subSectorIds);
            });
            Session::flash('success', __('labels.update_success'));
            return true;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " traceback: " . $exception->getTraceAsString());
            Session::flash('error', __('labels.update_fail') . '. '
                . __('labels.error_code', ['code' => $exception->getCode()]));
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteSector($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $this->delete($id);
                $this->pmsSubSectorRepository->deleteBySectorIdExceptSubSectors($id, []);
            });
            Session::flash('success', __('labels.delete_success'));
            return true;
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.delete_fail') . ', ' . __('labels.error_code', ['code' => $exception->getCode()]));
            return false;
        }
    }
}
