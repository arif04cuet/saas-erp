<?php

namespace Modules\IMS\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Repositories\ItemAppreciationDepreciationRecordRepository;

class ItemAppreciationDepreciationRecordService
{
    use CrudTrait;
    /**
     * @var ItemAppreciationDepreciationRecordRepository
     */
    private $appreciationDepreciationRecordRepository;

    /**
     * ItemAppreciationDepreciationRecordService constructor.
     * @param ItemAppreciationDepreciationRecordRepository $appreciationDepreciationRecordRepository
     */
    public function __construct(ItemAppreciationDepreciationRecordRepository $appreciationDepreciationRecordRepository)
    {
        $this->appreciationDepreciationRecordRepository = $appreciationDepreciationRecordRepository;
        $this->setActionRepository($appreciationDepreciationRecordRepository);
    }

    public function store(array $data)
    {
        try {
            $data['evaluation_date'] = Carbon::parse($data['evaluation_date'])->format('Y-m-d');
            $data['created_by'] = Auth::user()->id;
            return $this->save($data);
        } catch (\Exception $e) {
            Session::flash('error', __('labels.save_fail') . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

}

