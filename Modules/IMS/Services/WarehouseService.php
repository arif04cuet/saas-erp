<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 4/28/19
 * Time: 11:50 AM
 */

namespace Modules\IMS\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\IMS\Entities\Warehouse;
use Modules\IMS\Repositories\WarehouseRepository;

class WarehouseService
{
    use CrudTrait;

    /**
     * @var WarehouseRepository
     */
    private $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['date'] = Carbon::createFromFormat("j F, Y", $data['date']);
            $warehouse = $this->warehouseRepository->save($data);
            return $warehouse;
        });
    }

    public function getAllWarehouses()
    {
        return $this->warehouseRepository->findAll();
    }

    public function updateWarehouse(Warehouse $warehouse, array $data)
    {
        return DB::transaction(function () use ($warehouse, $data){
            $data['date'] = Carbon::createFromFormat("j F, Y", $data['date']);
            return $warehouse->update($data);
        });
    }

    public function getAllWarehousesForDropdown(Closure $implementedValue = null, Closure $implementedKey = null)
    {
        $warehouses = $this->warehouseRepository->findAll();

        $warehouseOptions = [];

        foreach ($warehouses as $warehouse){
            $warehouseId = $implementedKey ? $implementedKey($warehouse) : $warehouse->id;

            $implementedValue = $implementedValue ? : function($warehouse) {
                return $warehouse->name;
            };

            $warehouseOptions[$warehouseId] = $implementedValue($warehouse);
        }

        return $warehouseOptions;
    }
}