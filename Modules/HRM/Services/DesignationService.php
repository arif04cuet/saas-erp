<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/30/2018
 * Time: 12:43 PM
 */

namespace Modules\HRM\Services;


use Closure;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Utilities\DropDownDataFormatter;
use Modules\HRM\Repositories\DesignationRepository;

class DesignationService
{
    use CrudTrait;
    protected $designationRepository;

    public function __construct(DesignationRepository $designationRepository)
    {
        $this->designationRepository = $designationRepository;
        $this->setActionRepository($this->designationRepository);
    }

    public function getDesignationList()
    {
        return $this->designationRepository->findAll(null, null, ['column' => 'hierarchy_level', 'direction' => 'asc']);
    }

    public function getEmployeeDesignations()
    {
        return $this->designationRepository->findAll()->pluck('name', 'id')->toArray();
    }

    public function storeDesignation($data)
    {
        $designation = $this->save($data);
        if ($designation) {
            return new Response(trans('labels.save_success'));
        }


    }

    public function updateDepartment($data, $id)
    {
        $designation = $this->findOrFail($id);
        $status = $designation->update($data);
        if ($status) {
            return new Response(trans('labels.update_success'));
        }
    }

    public function deleteDepartment($id)
    {
        $designation = $this->findOrFail($id);
        $status = $designation->delete();
        if ($status) {
            return new Response(trans('labels.delete_success'));
        }
    }

    public function getDesignationByShortCode(array $shortCode)
    {
        return $this->designationRepository->getDesignationsByShortCode($shortCode);
    }

    public function getDesignation($id)
    {
        return $this->findOrFail($id);
    }

    public function getClassEmployeeByRank(int $rankId)
    {
        return $this->designationRepository->getClassEmployeeByRank($rankId);
    }

    public function getDesignationsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $designation = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll(null, null, ['column' => 'hierarchy_level', 'direction' => 'asc']);
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $designation,
            $implementedKey,
            $implementedValue ?: function ($designation) {
                return $designation->getName();
            },
            $isEmptyOption
        );
    }
}
