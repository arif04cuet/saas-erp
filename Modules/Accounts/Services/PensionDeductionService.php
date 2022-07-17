<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\DropDownDataFormatter;
use Closure;
use Modules\Accounts\Repositories\PensionDeductionRepository;

class PensionDeductionService
{
    use CrudTrait;

    public function __construct(PensionDeductionRepository $pensionDeductionRepository)
    {
        $this->setActionRepository($pensionDeductionRepository);
    }

    public function getDeductionsForDropdown(Closure $implementedValue = null, Closure $implementedKey = null, array $query = null, $isEmptyOption = false)
    {
        $deductions = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $deductions,
            $implementedKey,
            $implementedValue ?: function ($deduction) {
                return $deduction->name . ' - ' . $deduction->bangla_name;
            },
            $isEmptyOption
        );
    }
}

