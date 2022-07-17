<?php

/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 12/9/2018
 * Time: 1:16 PM
 */

namespace Modules\HM\Services;


use App\Constants\NotificationType;
use App\Entities\User;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Accounts\Entities\FiscalYear;
use Modules\HM\Entities\HostelBudget;
use Modules\HM\Entities\HostelBudgetTitle;
use Modules\HM\Repositories\HostelBudgetRepository;
use Illuminate\Support\Facades\Session;

class HostelBudgetService
{
    use CrudTrait;

    /**
     * @var HostelBudgetRepository
     */
    protected $hostelBudgetRepository;
    /**
     * @var HostelBudgetSectionService
     */
    private $hostelBudgetSectionService;
    /**
     * @var HostelBudgetTitleService
     */
    private $hostelBudgetTitleService;
    /**
     * @var HmAccountBalanceService
     */
    private $hmAccountBalanceService;

    public function __construct(
        HostelBudgetRepository $hostelBudgetRepository,
        HostelBudgetSectionService $hostelBudgetSectionService,
        HmAccountBalanceService $hmAccountBalanceService,
        HostelBudgetTitleService $hostelBudgetTitleService
    ) {
        $this->hostelBudgetRepository = $hostelBudgetRepository;
        $this->hostelBudgetSectionService = $hostelBudgetSectionService;
        $this->hostelBudgetTitleService = $hostelBudgetTitleService;
        $this->hmAccountBalanceService = $hmAccountBalanceService;
        $this->setActionRepository($this->hostelBudgetRepository);
    }

    public function storeHostelBudget($hostelBudgets = [], $hostelBudgetTitleId)
    {
        if (count($hostelBudgets) > 0) {
            $status = false;
            foreach ($hostelBudgets as $budget) {
                $budget['hostel_budget_title_id'] = $hostelBudgetTitleId;

                $sectionInput = $budget['hostel_budget_section_id'];
                $sectionId = (int)$sectionInput;

                $section = $this->hostelBudgetSectionService->checkSectionAvailability($sectionId);

                if (is_null($section)) {
                    $section = $this->hostelBudgetSectionService->save(['name' => $sectionInput]);
                    $budget['hostel_budget_section_id'] = $section['id'];
                }


                $status = $this->hostelBudgetRepository->save($budget);
            }
            if ($status) {
                $hostelBudgetTitle = $this->hostelBudgetTitleService->findOrFail($hostelBudgetTitleId);
                $approvedStatus = $hostelBudgetTitle->update(['status' => 3]);
                $this->sendNotification($hostelBudgetTitle);
            }

            return new Response(trans('hm::hostel_budget.add_successful'));
        }
    }

    public function approvedHostelBudget(array $hostelBudgets, $hostelBudgetTitleId)
    {
        $approvedStatus = false;
        $status = false;
        foreach ($hostelBudgets as $hostelBudget) {

            $budget = $this->findOrFail($hostelBudget['id']);
            $status = $budget->update($hostelBudget);
        }

        if ($status) {
            $hostelBudgetTitle = $this->hostelBudgetTitleService->findOrFail($hostelBudgetTitleId);
            $approvedStatus = $hostelBudgetTitle->update(['status' => 1]);
        }
        if ($approvedStatus) {
            return new Response(trans('hm::hostel_budget.approved_successful'));
        }
    }

    public function getBudgetMaxValuesForAllBudget()
    {
        $hostelBudgetTitles = $this->hostelBudgetTitleService->findAll();
        $maxBudgetValues = collect();
        foreach ($hostelBudgetTitles as $hostelBudgetTitle) {
            $maxBudgetValues[$hostelBudgetTitle->id] = $this->getHostelBudgetMaxValues($hostelBudgetTitle);
        }
        return $maxBudgetValues;
    }

    public function getHostelBudgetMaxValues(HostelBudgetTitle $hostelBudgetTitle)
    {
        try {
            $hostelBudgets = $hostelBudgetTitle->hostelBudgets ?? null;
            $maxBudgetValues = collect();
            if (!is_null($hostelBudgets)) {
                foreach ($hostelBudgets as $hostelBudget) {
                    $hostelBudgetSectionId = $hostelBudget->hostel_budget_section_id;
                    $max = $hostelBudget->budget_approved_amount
                        ? $hostelBudget->budget_approved_amount
                        : $hostelBudget->budget_amount;
                    $fiscalYear = $this->hostelBudgetTitleService->getFiscalYearFromHostelBudgetTitle($hostelBudgetTitle->id);
                    if (is_null($fiscalYear)) {
                        throw  new \Exception('Accounts Fiscal Year Not Found For ' . $hostelBudgetTitle->name);
                    }
                    $balanceInformation = $this->hmAccountBalanceService
                        ->getBalanceInformation($fiscalYear->id, $hostelBudgetSectionId);
                    $max -= $balanceInformation['total_payment_amount'];
                    if (isset($maxBudgetValues[$hostelBudgetSectionId])) {
                        $maxBudgetValues[$hostelBudgetSectionId] += $max;
                    } else {
                        $maxBudgetValues[$hostelBudgetSectionId] = $max;
                    }
                }
            }
            return $maxBudgetValues;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            Session::flash('error', $exception->getMessage());
            return;
        }
    }

    public function getBudgetOfAllHostelSection(HostelBudgetTitle $hostelBudgetTitle)
    {
        return $this
            ->findBy(['hostel_budget_title_id' => $hostelBudgetTitle->id])
            ->pluck('budget_approved_amount', 'hostel_budget_section_id');
    }

    public function sendNotification(HostelBudgetTitle $hostelBudgetTitle)
    {
        $hostelNotificationService = new HostelNotificationService(NotificationType::HM_BUDGET_SUBMISSION);
        $toUsers = config('hm.hostel_budget.notification');
        $fromUserId = auth()->user()->id ?? null;
        $message = trans('hm::hostel_budget.budget_submission');
        $url = route('hostel-budgets.edit', $hostelBudgetTitle->id);
        foreach ($toUsers as $key => $value) {
            $toUser = User::whereUsername($value)->first();
            if (is_null($toUser)) {
                continue;
            }
            $hostelNotificationService->sendNotification(
                $hostelBudgetTitle,
                $fromUserId,
                $toUser->id,
                $message,
                $url
            );
        }
    }
}
