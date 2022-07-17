<?php

namespace Modules\IMS\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Repositories\FiscalYearRepository;
use Modules\Accounts\Services\JournalEntryService;
use Modules\IMS\Repositories\ProcurementBillingItemRepository;
use Modules\IMS\Repositories\ProcurementBillingRepository;
use Exception;

class ProcurementAndBillingService
{
    use CrudTrait;

    /**
     * @var ProcurementBillingRepository
     */
    private $procurementBillingRepository;
    /**
     * @var ProcurementBillingItemRepository
     */
    private $procurementBillingItemRepository;
    /**
     * @var InventoryItemCategoryService
     */
    private $itemCategoryService;
    /**
     * @var InventoryItemService
     */
    private $inventoryItemService;
    /**
     * @var JournalEntryService
     */
    private $journalEntryService;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * ProcurementAndBillingService constructor.
     * @param ProcurementBillingRepository $procurementBillingRepository
     * @param ProcurementBillingItemRepository $procurementBillingItemRepository
     * @param InventoryItemCategoryService $itemCategoryService
     * @param InventoryItemService $inventoryItemService
     * @param JournalEntryService $journalEntryService
     * @param FiscalYearRepository $fiscalYearRepository
     */
    public function __construct(
        ProcurementBillingRepository $procurementBillingRepository,
        ProcurementBillingItemRepository $procurementBillingItemRepository,
        InventoryItemCategoryService $itemCategoryService,
        InventoryItemService $inventoryItemService,
        JournalEntryService $journalEntryService,
        FiscalYearRepository $fiscalYearRepository

    ) {
        $this->procurementBillingRepository = $procurementBillingRepository;
        $this->setActionRepository($procurementBillingRepository);
        $this->procurementBillingItemRepository = $procurementBillingItemRepository;
        $this->itemCategoryService = $itemCategoryService;
        $this->inventoryItemService = $inventoryItemService;
        $this->journalEntryService = $journalEntryService;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        try {
            DB::transaction(
                function () use ($data) {
                    $data['bill_date'] = Carbon::parse($data['bill_date'])->format('Y-m-d H:i:s');
                    $data['order_no'] = $this->generateOrderNo();
                    $procurement = $this->save($data);
                    $this->storeProcurementItems($data['procurement_item_entries'], $procurement);
                    $JournalEntry = $this->createJournalEntry($data['procurement_item_entries'], $procurement, $data['pay_type']);
                    $data['journal_entry_id'] = $JournalEntry->id;
                    $procurement->update($data);
                    //$procurement->items()->save($data['procurement_item_entries']);

                }
            );
            return true;
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' ' . __(
                'labels.error_code',
                ['code' => $e->getCode()]
            ));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param array $data
     * @param $procurement
     */
    public function storeProcurementItems(array $data, $procurement)
    {
        foreach ($data as $datum) {
            $datum['procurement_billing_id'] = $procurement->id;
            $this->procurementBillingItemRepository->save($datum);
            $this->createInventoryItems($datum, $procurement);
        }
    }

    /**
     * Creates inventory items for fixed asset
     * @param array $data
     * @param $procurement
     */
    public function createInventoryItems(array $data, $procurement)
    {
        $itemCategory = $this->itemCategoryService->findOne($data['inventory_item_category_id']);
        if ($itemCategory->type == config('constants.inventory_asset_types.fixed asset')) {
            $user = Auth::user();
            for ($count = 1; $count <= $data['quantity']; $count++) {
                $itemData = [
                    'inventory_item_category_id' => $itemCategory->id,
                    'inventory_location_id' => $procurement->to_location_id,
                    'unique_id' => $this->inventoryItemService->getUniqueId($itemCategory->id),
                    'title' => $data['item_name'],
                    'model' => '',
                    'unit_price' => $data['unit_price'],
                    'invoice_no' => $procurement->order_no,
                    'remark' => 'Added by ' . $user->name . ' through procurement',
                    'created_by' => $user->id
                ];
                $this->inventoryItemService->save($itemData);
            }
        }
    }


    /**
     * @param array $data
     * @param $savedItem
     * @param $payType
     * @throws Exception
     */
    public function createJournalEntry(array $data, $savedItem, $payType)
    {
        list($journalEntryData, $journalEntryDetailsData) = $this->prepareDataForJournalEntry($data, $savedItem);
        $createEntry = $this->journalEntryService->postJournalEntry([
            'journal_entry_meta_data' => $journalEntryData,
            'journal_entry_details' => $journalEntryDetailsData,
            'payment_type' => $payType,
        ]);
        return $createEntry;
    }

    /**
     * @param array $data
     * @param $savedItem
     * @return array
     * @throws Exception
     */
    private function prepareDataForJournalEntry(array $data, $savedItem)
    {
        $billSetting = $savedItem->billSetting;
        $billDate = Carbon::parse($savedItem->bill_date)->format('Y-m-d');
        $fiscalYear = $this->fiscalYearRepository->getFiscalYearFromDate($billDate);
        if (!$fiscalYear) {
            throw new Exception(__('ims::procurement.errors.fiscal_year'));
        }
        $journalEntryStatus = array_keys(config('constants.journal_entry.statuses'))[0];
        $journalEntryData = [
            'reference' => 'Inventory Purchase Order# ' . $savedItem->order_no,
            'date' => $billDate,
            'journal_id' => $billSetting->journal_id,
            'fiscal_year_id' => $fiscalYear->id,
            'status' => $journalEntryStatus
        ];

        $journalEntryDetailData = [];
        $total = 0;
        $totalVat = 0;
        $totalIt = 0;
        $source = 'revenue';
        $itemTransactionType = 'payment';
        $itemsEconomyCode = $billSetting->itemsEconomyCode->code ?? null;
        $paymentEconomyCode = optional($billSetting->journal)->credit_account_id ?? null;
        if ($savedItem->bill_type == config('constants.inventory_bill_types.auction_sale')) {
            $source = 'local';
            $itemTransactionType = 'receipt';
            $paymentEconomyCode = optional($billSetting->journal)->debit_account_id ?? null;
        }

        // Items journal entry
        foreach ($data as $key => $datum) {
            $total += $datum['total'];
            $totalVat += $datum['vat'];
            $totalIt += $datum['it'];
            $journalEntryDetailData[$key] = [
                'economy_code' => $itemsEconomyCode,
                'source' => $source,
                'account_transaction_type' => $itemTransactionType,
                'credit_amount' => $itemTransactionType == 'receipt' ? $datum['total'] : 0,
                'debit_amount' => $itemTransactionType == 'payment' ? $datum['total'] : 0,
                'is_cash_book_entry' => 0,
                'remark' => '',
            ];
        }
        // Vat entry
        if ($totalVat) {
            $journalEntryDetailData[] = [
                'economy_code' => optional($billSetting->vatEconomyCode)->code ?? null,
                'source' => 'local',
                'account_transaction_type' => 'receipt',
                'credit_amount' => $totalVat,
                'is_cash_book_entry' => 0,
                'remark' => 'Vat entry',
            ];
        }
        // Income Tax entry
        if ($totalIt) {
            $journalEntryDetailData[] = [
                'economy_code' => optional($billSetting->itEconomyCode)->code ?? null,
                'source' => 'local',
                'account_transaction_type' => 'receipt',
                'credit_amount' => $totalIt,
                'is_cash_book_entry' => 0,
                'remark' => 'Income Tax entry',
            ];
        }
        // Receipt or Payment Entry
        $journalEntryDetailData[] = [
            'economy_code' => $paymentEconomyCode,
            'source' => $source,
            'account_transaction_type' => $itemTransactionType,
            'credit_amount' => $itemTransactionType == 'payment' ? $total : 0,
            'debit_amount' => $itemTransactionType == 'receipt' ? $total : 0,
            'is_cash_book_entry' => 1,
            'remark' => ucwords($itemTransactionType) . ' for the order# ' . $savedItem->order_no,
        ];

        return [$journalEntryData, $journalEntryDetailData];
    }

    /**
     * @param string $type
     * @return int|string
     */
    public function generateOrderNo($type = 'PROC')
    {
        return $type . '-' . Carbon::parse()->format('y') . '-' . str_pad(
            $this->findAll()->count() + 1,
            5,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * @return array
     */
    public function getItemCategories()
    {
        return $this->itemCategoryService
            ->getItemCategoryForDropdown(null, null, null, true);
    }
}
