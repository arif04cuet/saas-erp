<?php

namespace Modules\Cafeteria\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\Role;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Cafeteria\Entities\CafeteriaFoodOrder;
use Modules\Cafeteria\Services\SalesService;
use Modules\Cafeteria\Services\CafeteriaInventoryService;
use Modules\Cafeteria\Repositories\CafeteriaFoodOrderRepository;
use Modules\Cafeteria\Repositories\CafeteriaFoodOrderItemRepository;
use vendor\project\StatusTest;

class CafeteriaFoodOrderService
{

    use CrudTrait;

    const CAFETERIA_TYPE_DESCRIPTION = 'Notification for any activity regrading research proposal';

    /**
     * @var CafeteriaFoodOrderRepository
     */

    private $cafeteriaFoodOrderRepository;

    /**
     * @var CafeteriaFoodOrderItemRepository
     */
    private $cafeteriaFoodOrderItemRepository;

    /**
     * @var CafeteriaFoodOrderItemService
     */
    private $cafeteriaFoodOrderItemService;

    /**
     * @var CafeteriaInventoryService
     */

    private $cafeteriaInventoryService;

    /**
     * @var SalesService
     */
    private $salesService;

    /**
     * @param CafeteriaFoodOrderRepository $cafeteriaFoodOrderRepository
     * @param CafeteriaFoodOrderItemRepository $cafeteriaFoodOrderItemRepository
     * @param CafeteriaFoodOrderItemService $cafeteriaFoodOrderItemService
     * @param CafeteriaInventoryService $cafeteriaInventoryService
     * @param SalesService $salesService
     */

    public function __construct(
        CafeteriaFoodOrderRepository $cafeteriaFoodOrderRepository,
        CafeteriaFoodOrderItemRepository $cafeteriaFoodOrderItemRepository,
        CafeteriaFoodOrderItemService $cafeteriaFoodOrderItemService,
        CafeteriaInventoryService $cafeteriaInventoryService,
        SalesService $salesService
    ) {
        $this->cafeteriaFoodOrderRepository = $cafeteriaFoodOrderRepository;
        $this->cafeteriaFoodOrderItemRepository = $cafeteriaFoodOrderItemRepository;
        $this->cafeteriaFoodOrderItemService = $cafeteriaFoodOrderItemService;
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
        $this->salesService = $salesService;
        $this->setActionRepository($this->cafeteriaFoodOrderRepository);
    }

    public function storeOrdersData(array $data)
    {
        DB::transaction(function () use ($data) {
            $data['requester'] = Auth::user()->id;
            $foodOrders = $this->save($data);

            foreach ($data['food-order-entries'] as $item) {
                $item['cafeteria_food_order_id'] = $foodOrders->id;
                $this->cafeteriaFoodOrderItemService->save($item);
            }

            if ($data['status'] != 'draft') {
                $this->foodOrderCreateNotification($data, $foodOrders);
            }
        });
    }

    public function foodOrderCreateNotification($data, $foodOrders)
    {
        $role = Role::where('name', 'ROLE_CAFETERIA_MANAGER')->first();

        $users = $role->users->pluck('id')->toArray();

        array_push($users, (int) $data['bill_to']);

        $message = trans('cafeteria::food-order.create_food_order');

        foreach ($users as $user) {
            $this->sendOrderNotification($foodOrders, $user, $message);
        }
    }

    public function getTypeName(): string
    {
        return NotificationTypeConstant::CAFETERIA_FOOD_ORDER;
    }

    public function getTypeDescription(): string
    {
        return self::CAFETERIA_TYPE_DESCRIPTION;
    }

    public function sendOrderNotification(
        CafeteriaFoodOrder $cafeteriaFoodOrder,
        $toUserId,
        $message
    ) {
        $notificationTypeArr = [
            'name' => $this->getTypeName(),
            'description' => $this->getTypeDescription(),
            'is_application_notification' => 1,
            'is_email_notification' => 0,
            'is_sms_notification' => 0,
            'icon_name' => '',
        ];

        $notificationType = NotificationType::firstOrCreate($notificationTypeArr);

        if ($toUserId && $toUserId != Auth::user()->id) {
            Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $cafeteriaFoodOrder->id,
                'from_user_id' => Auth::user()->id,
                'to_user_id' => $toUserId,
                'message' => $message,
                'item_url' => route('food-orders.show', $cafeteriaFoodOrder->id)
            ]);

            Session::has('success') ? Session::flash('success', Session::get('success'))
                :  Session::flash('success', 'Something went wrong!');;
        }
    }

    public function updateOrderList(array $data, $orderId)
    {
        DB::transaction(function () use ($data, $orderId) {

            $this->findOrFail($orderId)->update($data);

            foreach ($data['food-order-entries'] as $item) {
                $isItemExist = !empty($item['id']) ? $this->cafeteriaFoodOrderItemRepository->hasItemInList($item['id']) : false;

                if ($isItemExist) {
                    $findItem = $this->cafeteriaFoodOrderItemRepository->findOrFail($item['id']);
                    $findItem->update($item);
                } else {
                    $item['cafeteria_food_order_id'] = $orderId;
                    $item['status'] = Config::get('constants.cafeteria.status.pending');
                    $this->cafeteriaFoodOrderItemRepository->save($item);
                }
            }

            $getAllItemId = collect($data['food-order-entries'])->pluck('id')->toArray();

            $this->cafeteriaFoodOrderItemRepository->deleteIfItemNotInList($orderId, $getAllItemId);
        });
    }

    public function approveOrderList(array $data, $orderId)
    {
        DB::transaction(function () use ($data, $orderId) {

            $foodOrders = $this->findBy(['id' => $orderId])->first();

            $foodOrders = $this->update($foodOrders, $data);

            foreach ($data['food-order-entries'] as $item) {
                if (!isset($item['status']) || $data['status'] == "rejected") {
                    $item['status'] = Config::get('constants.cafeteria.status.rejected');
                } else {
                    $item['status'] = Config::get('constants.cafeteria.status.approved');

                    $this->updateInventory($item, $orderId);
                }

                $isItemExist = !empty($item['id']) ? $this->cafeteriaFoodOrderItemRepository->hasItemInList($item['id']) : false;

                if ($isItemExist) {
                    $findItem = $this->cafeteriaFoodOrderItemRepository->findOrFail($item['id']);
                    $findItem->update($item);
                } else {
                    $item['cafeteria_food_order_id'] = $orderId;
                    $this->cafeteriaFoodOrderItemRepository->save($item);
                }
            }

            if (!isset($item['status']) || $data['status'] != "rejected") {
                $salesData = $this->prepareDataGenerateSalesBill($data);
                $this->salesService->storeSalesData($salesData, 'orderSales');
            }

            $getAllItemId = collect($data['food-order-entries'])->pluck('id')->toArray();

            $this->cafeteriaFoodOrderItemRepository->deleteIfItemNotInList($orderId, $getAllItemId);

            $this->foodOrderApprovalNotification($foodOrders);
        });
    }

    public function foodOrderApprovalNotification($foodOrders)
    {
        $userIds = array_unique([$foodOrders->requester, $foodOrders->bill_to]);
        $message = trans('cafeteria::food-order.food_order_' . $foodOrders->status);
        $message = nl2br($message . "\n" . trans('cafeteria::food-order.order_title') . " - " . $foodOrders->title);
        foreach ($userIds as $userId) {
            $this->sendOrderNotification($foodOrders, $userId, $message);
        }
    }

    public function prepareDataGenerateSalesBill($data): array
    {
        $due = 0;
        $salesData = [
            'reference_type' => $data['reference_type'],
            'reference' => $data['reference'],
            'remark' => $data['remarks'],
            'paid' => 0,
            'sales_date' => $data['order_date']
        ];

        $salesData['sales-entries'] = [];

        foreach ($data['food-order-entries'] as $item) {
            if (!isset($item['status']) || $data['status'] == "rejected") {
                continue;
            }

            $tempArr = [
                'raw_material_id' => $item['raw_material_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'vat' => $item['vat'],
                'total_price' => $item['total_price']
            ];

            $due += $item['total_price'];

            $salesData['sales-entries'][] = $tempArr;
        }

        $salesData['due'] = $due;

        return $salesData;
    }

    public function updateInventory($item, $orderId)
    {
        $item['reference_table'] = Config::get('constants.cafeteria.reference_table.food-orders');
        $item['reference_table_id'] = $orderId;
        $item['status'] = Config::get('constants.cafeteria.status.deducted');

        $this->cafeteriaInventoryService->deductMaterialAmountFromInventory($item);
    }

    public function getFilterFoodOrderData()
    {
        if (Auth::user()->hasAnyRole(Config::get('constants.cafeteria.roles.cafeteria_manager')) || Auth::user()->hasAnyRole(Config::get('constants.cafeteria.roles.cafeteria_user'))) {
            $specialPurchaseLists = $this->cafeteriaFoodOrderRepository->foodOrderData();
        } else {
            $specialPurchaseLists = $this->findBy(
                ['requester' => Auth::user()->id],
                null,
                ['column' => 'id', 'direction' => 'DESC']
            );
        }

        return $specialPurchaseLists;
    }
}
