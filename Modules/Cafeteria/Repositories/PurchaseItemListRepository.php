<?php


namespace Modules\Cafeteria\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\PurchaseItemList;

class PurchaseItemListRepository extends AbstractBaseRepository
{

    protected $modelName = PurchaseItemList::class;

    public function hasItemInList($id)
    {
        return $this->model->where('id', $id)->count() ? true : false;
    }

    public function deleteIfItemNotInList($purchaseListId, $itemIds)
    {
        return $this->model->where('purchase_list_id', $purchaseListId)->whereNotIn('id', $itemIds)->delete();
    }

    public function purchaseReportDataByDateWise($request)
    {
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date =  Carbon::parse($request->end_date)->format('Y-m-d');
        $raw_material_id = $request->raw_material_id;
        $status = config('constants.cafeteria.status.approved');

        $base_query =  $this->model->when($raw_material_id, function ($query) use (
            $start_date,
            $end_date,
            $raw_material_id,
            $status
        ) {
            return $query->where('raw_material_id', $raw_material_id)
            ->where('status', $status)
            ->whereBetween('purchase_date', [$start_date, $end_date]);
        }, function ($query) use (
            $start_date,
            $end_date,
            $status
        ) {
            return $query->where('status', $status)
            ->whereBetween('purchase_date', [$start_date, $end_date]);
        });


        return $base_query->get();
    }

    public function purchaseReportDataByProductWise($request)
    {
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date =  Carbon::parse($request->end_date)->format('Y-m-d');
        $raw_material_id = $request->raw_material_id;
        $status = config('constants.cafeteria.status.approved');

        $base_query = $this->model->when($raw_material_id, function ($query) use (
            $raw_material_id, 
            $start_date, 
            $end_date, 
            $status) {
            return $query->where('raw_material_id', $raw_material_id)
                ->where('status', $status)
                ->whereBetween('purchase_date', [$start_date, $end_date])
                ->select(
                    'raw_material_id',
                    DB::raw('SUM(total_price) as total_price,
                                            SUM(quantity) as quantity')
                )
                ->groupBy('raw_material_id');
        }, function ($query) use ($start_date, $end_date, $status) {
            $query->when($start_date, function ($query) use (
                $start_date, 
                $end_date, 
                $status) {
                return $query->where('status', $status)
                    ->whereBetween('purchase_date', [$start_date, $end_date])
                    ->select(
                        'raw_material_id',
                        DB::raw('SUM(total_price) as total_price, 
                                                SUM(quantity) as quantity')
                    )
                    ->groupBy('raw_material_id');
            });
        });

        return $base_query->get();
    }
}
