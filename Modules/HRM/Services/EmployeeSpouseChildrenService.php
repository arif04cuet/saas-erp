<?php


namespace Modules\HRM\Services;


use App\Http\Responses\DataResponse;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\EmployeeSpouseChildrenInfo;
use Modules\HRM\Repositories\EmployeeSpouseChildrenRepository;

class EmployeeSpouseChildrenService
{
    use CrudTrait;

    protected $repository;

    private $dateFormat;

    private $formatKeys = [
        'date_of_birth'
    ];

    public function __construct(
        EmployeeSpouseChildrenRepository $employeeSpouseChildrenRepository
    )
    {
        $this->dateFormat = 'j F, Y';

        $this->repository = $employeeSpouseChildrenRepository;
        $this->setActionRepository($this->repository);
    }

    public function store($data, $employeeId)
    {
        return $employeeId;
    }

    public function update($data, $employeeId)
    {
        return DB::transaction(function () use ($data, $employeeId) {

            $spouses = $this->updateSpouses($data['spouses'] ?? [], $employeeId);

            $children = $this->updateChildren($data['children'] ?? [], $employeeId);

            if ($spouses && $children) {
                return new DataResponse(
                    collect([
                        'spouses' => $spouses,
                        'children' => $children
                    ]),
                    $data['employee_id'],
                    trans('labels.Spouse & Children information updated successfully')
                );
            } else {
                return new DataResponse(
                    $data,
                    null,
                    trans('labels.Spouse & Children information not updated')
                );
            }
        });

    }

    public function spouse($employeeId, $type = "spouse")
    {
        return $this->repository->findBy([
            'employee_id' => $employeeId,
            'type' => $type
        ])->map(function ($spouse) {
            $spouse->date_of_birth = !is_null($spouse->date_of_birth) ?
                Carbon::parse($spouse->date_of_birth)->format('j F, Y')
                : null;
            return $spouse;
        })->first();
    }

    public function spouses($employeeId, $type = "spouse")
    {
        return $this->repository->findBy([
            'employee_id' => $employeeId,
            'type' => $type,
        ])->map(function ($spouse) {
            $spouse->date_of_birth = !is_null($spouse->date_of_birth) ?
                Carbon::parse($spouse->date_of_birth)->format('j F, Y')
                : null;
            return $spouse;
        });
    }

    public function children($employeeId, $type = "child")
    {
        return $this->repository->findBy([
            'employee_id' => $employeeId,
            'type' => $type
        ])->map(function ($child) {
            $child->date_of_birth = !is_null($child->date_of_birth) ?
                Carbon::parse($child->date_of_birth)->format('j F, Y')
                : null;
            return $child;
        });
    }

    private function updateSpouses($data, $employeeId)
    {
        $spousesShouldBeUpdated = $this->getSpousesIdsToUpdate($data ?: []);

        $deletes = $this->getSpousesToDelete($employeeId, $spousesShouldBeUpdated)
            ->each(function ($delete) {
                $delete->delete();
            });

        if(!empty($data)) {
            $updateOrSaves = collect($data)
                ->each(function ($spouse) use($employeeId) {
                    $spouse['type'] = 'spouse';

                    if(!isset($spouse['is_attestation_letter_submitted'][0])) {
                        $spouse['is_attestation_letter_submitted'] = false;
                    }else {
                        $spouse['is_attestation_letter_submitted'] = true;
                    }

                    $spouse['employee_id'] = $employeeId;
                    $this->repository->getModel()->updateOrCreate(
                        [
                            'id' => $spouse['id']
                        ],
                        $this->format($spouse)
                    );
                });

            return $updateOrSaves;
        }

        return $deletes;
    }

    private function updateChildren($data, $employeeId)
    {
        $childrenShouldBeUpdated = $this->getChildrenIdsToUpdate($data ?: []);

        $deletes = $this->getChildrenToDelete($employeeId, $childrenShouldBeUpdated)
            ->each(function ($delete) {
                $delete->delete();
            });

        if (!empty($data)) {
            $updateOrSaves = collect($data)
                ->each(function ($child) use ($employeeId) {
                    $child['type'] = 'child';
                    if(!isset($child['is_attestation_letter_submitted'][0])) {
                        $child['is_attestation_letter_submitted'] = false;
                    }else {
                        $child['is_attestation_letter_submitted'] = true;
                    }

                    $child['employee_id'] = $employeeId;
                    $this->repository->getModel()->updateOrCreate(
                        [
                            'id' => $child['id']
                        ],
                        $this->format($child)
                    );
                });

            return $updateOrSaves;
        }

        return $deletes;
    }

    private function format($data)
    {
        collect($this->formatKeys)->each(function ($key) use (&$data) {
            if (isset($data[$key])) {
                $data[$key] = !is_null($data[$key])
                    ? Carbon::createFromFormat($this->dateFormat, $data[$key])->format('Y-m-d')
                    : null;
            }
        });

        return $data;
    }

    private function getChildrenIdsToUpdate(array $data)
    {
        return array_filter(array_column($data, 'id'));
    }

    private function getSpousesIdsToUpdate(array $data)
    {
        return array_filter(array_column($data, 'id'));
    }

    private function getChildrenToDelete($employeeId, $childrenIdsShouldBeUpdated)
    {
        return $this->repository->findBy([
            'employee_id' => $employeeId,
            'type' => 'child'
        ])->filter(function ($child) use ($childrenIdsShouldBeUpdated) {
            return !in_array($child->id, $childrenIdsShouldBeUpdated);
        });
    }

    private function getSpousesToDelete($employeeId, $spousesIdsShouldBeUpdated)
    {
        return $this->repository->findBy([
            'employee_id' => $employeeId,
            'type' => 'spouse',
        ])->filter(function($spouse) use ($spousesIdsShouldBeUpdated) {
            return !in_array($spouse->id, $spousesIdsShouldBeUpdated);
        });
    }
}
