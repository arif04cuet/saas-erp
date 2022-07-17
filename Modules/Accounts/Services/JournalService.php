<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Modules\Accounts\Repositories\EconomyCodeRepository;
use Modules\Accounts\Repositories\JournalRepository;
use Modules\HRM\Entities\Department;
use Modules\HRM\Services\DepartmentService;

class JournalService
{
    use CrudTrait;

    protected $journalRepository;

    /**
     * @var Department
     */
    private $departmentService;

    /**
     * JournalService constructor.
     * @param JournalRepository $journalRepository
     * @param DepartmentService $departmentService
     */
    public function __construct(JournalRepository $journalRepository, DepartmentService $departmentService)
    {
        $this->journalRepository = $journalRepository;
        $this->departmentService = $departmentService;
        $this->setActionRepository($this->journalRepository);
    }

    public function getjournalsForDropdown(Closure $implementedValue = null, Closure $implementedKey = null)
    {
        $journals = $this->journalRepository->findAll();

        $journalOptions = [];

        foreach ($journals as $journal) {
            $journalId = $implementedKey ? $implementedKey($journal) : $journal->id;

            $implementedValue = $implementedValue ?: function ($journal) {
                return $journal->name;
            };

            $journalOptions[$journalId] = $implementedValue($journal);
        }

        return $journalOptions;
    }

    public function getDepartmentJournals($departmentCode)
    {
        $department = $this->departmentService->getDepartmentByCode($departmentCode);
        return $this->actionRepository->getDepartmentJournals($department->id);
    }
}
