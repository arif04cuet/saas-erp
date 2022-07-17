<?php


namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\EmployeeReligion;
use Modules\HRM\Repositories\EmployeeReligionRepository;

class EmployeeReligionService
{
    use CrudTrait;

    private $repository;

    public function __construct(
        EmployeeReligionRepository $employeeReligionRepository
    )
    {
        $this->repository = $employeeReligionRepository;
        $this->setActionRepository($this->repository);
    }

    public function religions()
    {
        $religions = $this->repository->findAll();

        return $religions;
    }

    public function religion(EmployeeReligion $religion)
    {
        $religion = $this->repository->findOne($religion->id);

        return $religion;
    }

    public function store($data = [])
    {
        return DB::transaction(function () use ($data) {

            $religion = false;

            if (!empty($data)) {

                $religion = $this->repository->save($data);
            }

            return $religion;
        });
    }

    public function update(EmployeeReligion $religion, $data)
    {
        return DB::transaction(function () use ($religion, $data) {
           $update = false;

           if($religion && !empty($data)) {
               $update = $this->repository->update($religion, $data);
           }

           return $update;
        });
    }

    public function dropDown()
    {
        $religions = $this->repository->findAll()
            ->mapWithKeys(function($religion) {
                $locale = trans('hrm::employee.religion.locale');

                return [$religion->id => $religion->$locale];
            });

        return $religions;
    }
}
