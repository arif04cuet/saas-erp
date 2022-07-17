<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Repositories\TmsSectorRepository;
use Modules\TMS\Repositories\TmsSubSectorRepository;

class TmsSectorService
{
    use CrudTrait;
    /**
     * @var TmsSectorRepository
     */
    private $tmsSectorRepository;
    /**
     * @var TmsSubSectorRepository
     */
    private $tmsSubSectorRepository;

    /**
     * TmsSectorService constructor.
     * @param TmsSectorRepository $tmsSectorRepository
     * @param TmsSubSectorRepository $tmsSubSectorRepository
     */
    public function __construct(
        TmsSectorRepository $tmsSectorRepository,
        TmsSubSectorRepository $tmsSubSectorRepository
    ) {
        $this->tmsSectorRepository = $tmsSectorRepository;
        $this->setActionRepository($tmsSectorRepository);
        $this->tmsSubSectorRepository = $tmsSubSectorRepository;
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
                    $data['code'] = $this->generateCode();
                    $saveSector = $this->save($data);

                    foreach ($data['sub_sectors'] as $sub_sector) {
                        $sub_sector['tms_sector_id'] = $saveSector->id;
                        $sub_sector['code'] = $this->generateCode();
                        $saveSubSector = $this->tmsSubSectorRepository->save($sub_sector);
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
                        $sub_sector['tms_sector_id'] = $id;
                        $sub_sector['code'] = $this->generateCode();
                        $saveSubSector = $this->tmsSubSectorRepository->save($sub_sector);
                        $subSectorIds[] = $saveSubSector->id;
                    } else {
                        $subSectorIds[] = $sub_sector['id'];
                        $this->tmsSubSectorRepository->findOrFail($sub_sector['id'])->update($sub_sector);
                    }
                }
                // Deleting sub-sectors that are in DB but not in the updated sub-sector request
                $this->tmsSubSectorRepository->deleteBySectorIdExceptSubSectors($id, $subSectorIds);
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
                $this->tmsSubSectorRepository->deleteBySectorIdExceptSubSectors($id, []);
            });
            Session::flash('success', __('labels.delete_success'));
            return true;
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.delete_fail') . ', ' . __('labels.error_code', ['code' => $exception->getCode()]));
            return false;
        }
    }

    /**
     * Method that returns a system generated unique code for sectors and sub-sectors
     * @return string
     */
    public function generateCode()
    {
        return date('ymdhis').rand(1000, 9999);
    }

}

