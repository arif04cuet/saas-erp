<?php


namespace Modules\Cafeteria\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Cafeteria\Entities\Sales;
use App\Repositories\AbstractBaseRepository;

class SalesRepository extends AbstractBaseRepository
{

    protected $modelName = Sales::class;

    public function getSalesFilterData($request)
    {
        $paymentType = $request->payment_type;
        $raw_material_id = $request->raw_material_id;
        $biller_type = $request->biller_type;
        $employee_id = $request->employee_id;
        $training_id = $request->training_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $base_query = $this->model->whereBetween('sales_date', [$start_date, $end_date])
            ->when($paymentType, function ($query) use ($paymentType) {
                return $query->when($paymentType == 'paid', function ($query) {
                    $query->where('paid', '!=', 'null');
                }, function ($query) {
                    $query->where('due', '!=', 'null');
                });
            })->when($raw_material_id, function ($query) use ($raw_material_id) {
                return $query->from('sales')
                ->leftjoin('sales_items', 'sales_items.sales_id', '=', 'sales.id')
                ->selectRaw(
                    'sales.sales_date,
                     SUM(sales_items.quantity) as quantity, 
                     SUM(sales_items.total_price) as total_price'
                )->where('sales_items.raw_material_id', $raw_material_id)
                ->groupBy('sales.sales_date')
                ;
            })->when($biller_type, function ($query) use ($biller_type) {
                return $query->where('reference_type', $biller_type);
            })->when($employee_id, function($query) use ($employee_id) {
                return $query->select(
                    'sales_date',
                    DB::raw('SUM(paid) as paid, SUM(due) as due')
                )
                ->where('reference', $employee_id)->groupBy('sales_date');
            })->when($training_id, function($query) use ($training_id) {
                return $query->
                select(
                    'sales_date',
                    DB::raw('SUM(paid) as paid, SUM(due) as due')
                )
                ->where('reference', $training_id)->groupBy('sales_date');
            });
        
        return $base_query->get();
    }
}
