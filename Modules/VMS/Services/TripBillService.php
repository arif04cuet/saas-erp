<?php

namespace Modules\VMS\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Entities\SalaryRule;
use Modules\Accounts\Services\EmployeeSalaryOutstandingService;
use Modules\Accounts\Services\FiscalYearService;
use Modules\Accounts\Services\JournalEntryService;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Services\TmsJournalEntryService;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\TripBillPayment;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Entities\VehicleFuelBillSubmit;
use Modules\VMS\Entities\VehicleMaintenanceRequisition as VMRequisition;

class TripBillService
{
    /**
     * @var TripCalculationSettingService
     */
    private $tripCalculationSettingService;
    /**
     * @var EmployeeSalaryOutstandingService
     */
    private $employeeSalaryOutstandingService;
    /**
     * @var VmsIntegrationSettingService
     */
    private $vmsIntegrationSettingService;
    /**
     * @var JournalEntryService
     */
    private $journalEntryService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;
    /**
     * @var TmsJournalEntryService
     */
    private $tmsJournalEntryService;
    /**
     * @var TripBillPaymentService
     */
    private $tripBillPaymentService;

    public function __construct(
        TripCalculationSettingService $tripCalculationSettingService,
        EmployeeSalaryOutstandingService $employeeSalaryOutstandingService,
        VmsIntegrationSettingService $vmsIntegrationSettingService,
        FiscalYearService $fiscalYearService,
        TmsJournalEntryService $tmsJournalEntryService,
        TripBillPaymentService $tripBillPaymentService,
        JournalEntryService $journalEntryService
    ) {
        $this->tripCalculationSettingService = $tripCalculationSettingService;
        $this->employeeSalaryOutstandingService = $employeeSalaryOutstandingService;
        $this->vmsIntegrationSettingService = $vmsIntegrationSettingService;
        $this->fiscalYearService = $fiscalYearService;
        $this->tmsJournalEntryService = $tmsJournalEntryService;
        $this->tripBillPaymentService = $tripBillPaymentService;
        $this->journalEntryService = $journalEntryService;
    }

    /**
     * @param Trip $trip
     * @return Collection
     * @throws Exception
     */
    public function calculateBillForTrip(Trip $trip)
    {
        $trip = $this->addBillInfo($trip);
        $activeSetting = null;
        $activeSetting = $this->tripCalculationSettingService->getActiveSettingForTrip($trip->requester);
        $fuelTypes = Vehicle::getFuelTypes();
        if (is_null($activeSetting)) {
            throw new Exception('No Calculation Setting Found !');
        }
        $total = 0;
        $trip->vehicles->map(function ($v) use ($activeSetting, $trip, $fuelTypes, &$total) {
            $distance = $trip->distance ?? 0;
            if (!is_null($trip->completed_distance)) {
                $distance = $trip->completed_distance;
            }
            $fuelPrice = 0;
            if ($v->fuel_type == $fuelTypes['gas']) {
                $fuelPrice = $activeSetting->gas_price ?? 0;
            }
            if ($v->fuel_type == $fuelTypes['oil']) {
                $fuelPrice = $activeSetting->oil_price ?? 0;
            }
            $v->fuelPrice = $fuelPrice;
            $v->bill = ($distance * $activeSetting->per_km_taka) + ($trip->trip_length_hour * $activeSetting->per_hour_taka);
            $total += $v->bill;
            return $v;
        });
        $trip = collect([$trip])->map(function ($t) use ($total, $trip) {
            $distance = $trip->distance ?? 0;
            if (!is_null($trip->completed_distance)) {
                $distance = $trip->completed_distance;
            }
            $t->total = $total;
            $t->calculated_distance = $distance;
            return $t;
        });
        return $trip->first();
    }

    public function getActiveSettingForTrip(Trip $trip)
    {
        return $this->tripCalculationSettingService->getActiveSettingForTrip($trip->requester);
    }

    public function makePayment(Trip $trip, array $data)
    {
        try {
            DB::beginTransaction();
            $option = $data['payment_option'];
            $paymentOptions = Trip::getPaymentOptions();
            $trip = $this->calculateBillForTrip($trip);
            if (!array_key_exists($option, $paymentOptions)) {
                throw new Exception(trans('vms::trip.bill.flash_messages.payment_error'));
            }

            if ($option == $paymentOptions['payroll']) {
                $this->addBillAsSalaryOutstanding($trip);
            } elseif ($option == $paymentOptions['accounts']) {
                $this->addJournalEntryToAccounts($trip);
            } elseif ($option == $paymentOptions['tms_accounts']) {
                $this->addJournalEntryToTms($trip);
            } else {
                // project - doing nothing for now as PMS budget feature is garbage
            }
            $billPaymentData = $this->createBillPaymentArray($trip, $data['payment_option']);
            $this->tripBillPaymentService->store($billPaymentData);
            Session::flash('success', trans('vms::trip.flash_messages.payment_success'));
            DB::commit();;
            return true;
        } catch (\Exception $exception) {
            DB::rollback();
            Session::flash('payment-error', trans($exception->getMessage()));
            return false;
        }
    }

    public function submitVehicleFuelBillToAccounts(VehicleFuelBillSubmit $fuelBil)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $masterArray = [];
        $journalEntryArray = [];
        $journalEntryDetailArray = [];
        //create journal entry meta data  array
        $journalEntryArray['date'] = Carbon::now()->format('Y-m-d');
        $journalEntryArray['reference'] = 'Fuel Bill From ' . $fuelBil->fillingStation->name ?? '';
        $journalEntryArray['fiscal_year_id'] = $this->fiscalYearService
            ->getFiscalYearByDate($todayDate)->id;
        // for each entry, create journal entry detail array
        $tempArray = [];
        $integrationSetting = $this->getIntegrationSetting();
        if (is_null($integrationSetting)) {
            throw new Exception('No Integration Setting Found !');
        }
        if (empty($integrationSetting->fuel_bill_economy_code)) {
            throw new Exception('Fuel Bill Economy Code Not Defined In The Setting');
        }
        if (empty($integrationSetting->accounts_bank_cash_economy_code)) {
            throw new Exception('Accounts Bank/Cash Not Defined In The Setting');
        }

        $tempArray['economy_code'] = $integrationSetting->fuel_bill_economy_code->code ?? null;
        $tempArray['credit_amount'] = 0;
        $tempArray['debit_amount'] = $fuelBil->amount ?? 0;
        $tempArray['source'] = JournalEntryDetail::getSources()[1]; // revenue  expense
        $tempArray['account_transaction_type'] = array_keys(JournalEntry::getTransactionTypes())[1];// payment
        $tempArray['remark'] = 'Fuel Bill Submission From' . $fuelBil->fillingStation->name ?? '';
        $tempArray['is_cash_book_entry'] = 0;
        $journalEntryDetailArray[] = $tempArray;
        // create the bank-cash entry again
        $tempArray['economy_code'] = $integrationSetting->accounts_bank_cash_economy_code ?? null;
        $tempArray['credit_amount'] = $fuelBil->amount ?? 0;
        $tempArray['debit_amount'] = 0;
        $tempArray['source'] = JournalEntryDetail::getSources()[1]; // revenue expense
        $tempArray['account_transaction_type'] = array_keys(JournalEntry::getTransactionTypes())[1];// receipt
        $tempArray['remark'] = 'Cash/Bank Entry For Fuel Bill Submission';
        $tempArray['is_cash_book_entry'] = 1;
        $journalEntryDetailArray[] = $tempArray;
        // wrap it up and send to accounts
        $masterArray['journal_entry_meta_data'] = $journalEntryArray;
        $masterArray['journal_entry_details'] = $journalEntryDetailArray;
        $masterArray['payment_type'] = array_keys(JournalEntry::getPaymentTypes())[1];// cash;
        $this->journalEntryService->postJournalEntry($masterArray);
        return true;
    }

    public function submitVehicleMaintenanceBillToAccounts(VMRequisition $vmRequisition)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $masterArray = [];
        $journalEntryArray = [];
        $journalEntryDetailArray = [];
        //create journal entry meta data  array
        $journalEntryArray['date'] = Carbon::now()->format('Y-m-d');
        $journalEntryArray['reference'] = 'Vehicle Maintenance Bill From ' . $vmRequisition->driver->getName() ?? '';
        $journalEntryArray['fiscal_year_id'] = $this->fiscalYearService
            ->getFiscalYearByDate($todayDate)->id;
        // for each entry, create journal entry detail array
        $tempArray = [];
        $integrationSetting = $this->getIntegrationSetting();
        if (is_null($integrationSetting)) {
            throw new Exception('No Integration Setting Found !');
        }
        if (empty($integrationSetting->vehicle_maintenance_economy_code)) {
            throw new Exception('Vehicle Maintenance Bill From  Not Defined In The Setting');
        }
        if (empty($integrationSetting->accounts_bank_cash_economy_code)) {
            throw new Exception('Accounts Bank/Cash Not Defined In The Setting');
        }

        $tempArray['economy_code'] = $integrationSetting->vehicle_maintenance_economy_code->code ?? null;
        $tempArray['credit_amount'] = 0;
        $tempArray['debit_amount'] = $vmRequisition->total_amount ?? 0;
        $tempArray['source'] = JournalEntryDetail::getSources()[1]; // revenue  expense
        $tempArray['account_transaction_type'] = array_keys(JournalEntry::getTransactionTypes())[1];// payment
        $tempArray['remark'] = 'Fuel Bill Submission From' . $vmRequisition->driver->getName() ?? '';
        $tempArray['is_cash_book_entry'] = 0;
        $journalEntryDetailArray[] = $tempArray;
        // create the bank-cash entry again
        $tempArray['economy_code'] = $integrationSetting->accounts_bank_cash_economy_code ?? null;
        $tempArray['credit_amount'] = $vmRequisition->total_amount ?? 0;
        $tempArray['debit_amount'] = 0;
        $tempArray['source'] = JournalEntryDetail::getSources()[1]; // revenue expense
        $tempArray['account_transaction_type'] = array_keys(JournalEntry::getTransactionTypes())[1];// receipt
        $tempArray['remark'] = 'Cash/Bank Entry For Fuel Bill Submission';
        $tempArray['is_cash_book_entry'] = 1;
        $journalEntryDetailArray[] = $tempArray;
        // wrap it up and send to accounts
        $masterArray['journal_entry_meta_data'] = $journalEntryArray;
        $masterArray['journal_entry_details'] = $journalEntryDetailArray;
        $masterArray['payment_type'] = array_keys(JournalEntry::getPaymentTypes())[1];// cash;
        $this->journalEntryService->postJournalEntry($masterArray);
        return true;
    }


//---------------------------------------------------------------------------------------------------------------
//                                             Private Function
//---------------------------------------------------------------------------------------------------------------

    private function createBillPaymentArray(Trip $trip, $paymentOption)
    {
        return [
            'trip_id' => $trip->id,
            'payment_option' => $paymentOption,
            'status' => TripBillPayment::getPaymentStatus()['paid'],
            'amount' => $trip->total
        ];
    }

    private function addBillAsSalaryOutstanding(Trip $trip)
    {
        $outStandingData = [];
        $data = [];
        $integrationSetting = $this->getIntegrationSetting();
        if (empty($integrationSetting->salary_rule_id)) {
            throw new Exception('Salary Rule Not Set In The Setting');
        }
        if (empty($trip->billed_to)) {
            throw new Exception('Billed To Information Not Set');
        }
        $outStandingData['salary_rule_id'] = $integrationSetting->salary_rule_id;
        $outStandingData['month'] = Carbon::parse($trip->start_date_time)->format('F,Y');
        $outStandingData['employee_id'] = $trip->billed_to;
        $outStandingData['amount'] = $trip->total ?? 0;
        $data[] = $outStandingData;
        $this->employeeSalaryOutstandingService->saveData($data, $outStandingData['employee_id']);
        return true;
    }

    /**
     * @param Trip $trip
     * @return Collection
     */
    private function addBillInfo(Trip $trip)
    {
        $trip = collect([$trip])->map(function ($t) {
            $startTime = $t->start_date_time;
            $endTime = $t->end_date_time;
            if (!is_null($t->actual_start_date_time)) {
                $startTime = $t->actual_start_date_time;
            }
            if (!is_null($t->actual_end_date_time)) {
                $endTime = $t->actual_end_date_time;
            }
            $t->trip_length_hour = $endTime->diffInHours($startTime);
            if ($t->trip_length_hour < 1) {
                $t->trip_length_hour = 1;
            }
            if ($this->isFeedbackGiven($t)) {
                $t->is_feedback_given = 1;
            } else {
                $t->is_feedback_given = 0;
            }
            return $t;
        });
        return $trip->first();
    }

    private function isFeedbackGiven(Trip $trip)
    {
        if (!is_null($trip->actual_start_date_time)
            && !is_null($trip->actual_end_date_time)
            && !is_null($trip->completed_distance)) {
            return true;
        }
        return false;
    }

    private function getIntegrationSetting()
    {
        $integrationSetting = $this->vmsIntegrationSettingService->getActiveSetting();
        if (is_null($integrationSetting)) {
            throw new Exception('No Integration Setting Found');
        } else {
            return $integrationSetting;
        }
    }

    private function addJournalEntryToAccounts(Trip $trip)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $masterArray = [];
        $journalEntryArray = [];
        $journalEntryDetailArray = [];
        //create journal entry meta data  array
        $journalEntryArray['date'] = Carbon::now()->format('Y-m-d');
        $journalEntryArray['reference'] = 'Trip Bill For ' . $trip->billedTo->getName();
        $journalEntryArray['fiscal_year_id'] = $this->fiscalYearService
            ->getFiscalYearByDate($todayDate)->id;
        // for each entry, create journal entry detail array
        $tempArray = [];
        $integrationSetting = $this->getIntegrationSetting();
        if (is_null($integrationSetting)) {
            throw new Exception('No Integration Setting Found !');
        }
        if (empty($integrationSetting->salary_rule_id)) {
            throw new Exception('Salary Rule Not Defined In The Setting');
        }
        if (empty($integrationSetting->accounts_bank_cash_economy_code)) {
            throw new Exception('Accounts Bank/Cash Not Defined In The Setting');
        }
        // create the expense entry
        $trip = $this->calculateBillForTrip($trip);
        $salaryRule = SalaryRule::find($integrationSetting->salary_rule_id);
        if (is_null($salaryRule)) {
            throw new Exception('Salary Rule Not Found In Accounts Module !');
        }
        $tempArray['economy_code'] = $salaryRule->credit_economy_code->code ?? null;
        $tempArray['credit_amount'] = $trip->total ?? 0;
        $tempArray['debit_amount'] = 0;
        $tempArray['source'] = JournalEntryDetail::getSources()[0]; // local Income
        $tempArray['account_transaction_type'] = array_keys(JournalEntry::getTransactionTypes())[0];// receipt
        $tempArray['remark'] = 'Trip Billed For ' . $trip->billedTo->getName();
        $tempArray['is_cash_book_entry'] = 0;
        $journalEntryDetailArray[] = $tempArray;
        // create the bank-cash entry again
        $tempArray['economy_code'] = $integrationSetting->accounts_bank_cash_economy_code ?? null;
        $tempArray['credit_amount'] = 0;
        $tempArray['debit_amount'] = $trip->total ?? 0;
        $tempArray['source'] = JournalEntryDetail::getSources()[0]; // revenue
        $tempArray['account_transaction_type'] = array_keys(JournalEntry::getTransactionTypes())[0];// receipt
        $tempArray['remark'] = 'Trip Billed For ' . $trip->billedTo->getName();
        $tempArray['is_cash_book_entry'] = 1;
        $journalEntryDetailArray[] = $tempArray;
        // wrap it up and send to accounts
        $masterArray['journal_entry_meta_data'] = $journalEntryArray;
        $masterArray['journal_entry_details'] = $journalEntryDetailArray;
        $masterArray['payment_type'] = array_keys(JournalEntry::getPaymentTypes())[1];// cash;
        $this->journalEntryService->postJournalEntry($masterArray);
        return true;
    }

    private function addJournalEntryToTms(Trip $trip)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $masterArray = [];
        $journalEntryArray = [];
        //create journal entry meta data  array
        $masterArray['date'] = Carbon::now()->format('Y-m-d');
        $masterArray['title'] = 'Trip Bill For ' . $trip->billedTo->getName();
        $masterArray['training_id'] = $trip->training_id;
        $masterArray['fiscal_year_id'] = $this->fiscalYearService
            ->getFiscalYearByDate($todayDate)->id;
        // for each entry, create journal entry and cash entry array
        $integrationSetting = $this->getIntegrationSetting();
        if (is_null($integrationSetting)) {
            throw new Exception('No Integration Setting Found !');
        }
        if (empty($integrationSetting->tms_sub_sector_id)) {
            throw new Exception('Tms Sub Sector Not Defined In The Setting');
        }
        if (empty($integrationSetting->tms_bank_cash_economy_code)) {
            throw new Exception('TMS Bank/Cash Not Defined In The Setting');
        }
        if (empty($trip->training_id)) {
            throw new Exception('No Training Defined For This Trip !');
        }
        // create the expense entry
        $trip = $this->calculateBillForTrip($trip);

        $journalEntryArray['tms_sub_sector_id'] = $integrationSetting->tms_sub_sector_id ?? null;
        $journalEntryArray['credit_amount'] = $trip->total ?? 0;
        $journalEntryArray['debit_amount'] = 0;
        $journalEntryArray['transaction_type'] = array_keys(TmsJournalEntry::transactionTypes())[0];// receipt
        $journalEntryArray['remark'] = 'Trip Billed For ' . $trip->billedTo->getName();
        $journalEntryArray['is_cash_book_entry'] = 0;
        $tempArray[] = $journalEntryArray;
        $masterArray['tms_journal_entries'] = $tempArray;
        // create the bank-cash entry again
        $tempArray['tms_sub_sector_id'] = $integrationSetting->tms_bank_cash_economy_code ?? null;
        $tempArray['credit_amount'] = 0;
        $tempArray['debit_amount'] = $trip->total ?? 0;
        $tempArray['transaction_type'] = array_keys(TmsJournalEntry::transactionTypes())[0];// receive
        $tempArray['remark'] = 'Trip Billed For ' . $trip->billedTo->getName();
        $tempArray['is_cash_book_entry'] = 1;
        $tempArray['payment_type'] = array_keys(TmsJournalEntry::paymentTypes())[1];// cash;
        $masterArray['cash_book_entries'] = $tempArray;
        // wrap it up and send to tms Accounts
        $this->tmsJournalEntryService->store($masterArray);
        return true;
    }

}

