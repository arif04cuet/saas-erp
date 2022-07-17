<?php

namespace Modules\Cafeteria\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Traits\CrudTrait;
use App\Entities\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Modules\Cafeteria\Services\CafeteriaInventoryService;
use Modules\Cafeteria\Services\DeliverMaterialItemService;
use Modules\Cafeteria\Repositories\DeliverMaterialRepository;

class DeliverMaterialService
{
    use CrudTrait;

    /**
     * @var $deliverMaterialRepository
     * @var $deliverMaterialItemService
     * @var $cafeteriaInventoryService
     */

    private $deliverMaterialRepository;
    private $deliverMaterialItemService;
    private $cafeteriaInventoryService;

    const DELIVERY_MATERIAL_NOTIFICATION_DESCRIPTION = 'Notification for delivery material requeest';


    /**
     * @param DeliverMaterialRepository $deliverMaterialRepository
     * @param DeliverMaterialItemService $deliverMaterialItemService
     * @param CafeteriaInventoryService $cafeteriaInventoryService
     */

    public function __construct(
        DeliverMaterialRepository $deliverMaterialRepository,
        DeliverMaterialItemService $deliverMaterialItemService,
        CafeteriaInventoryService $cafeteriaInventoryService
    ) {
        $this->deliverMaterialRepository = $deliverMaterialRepository;
        $this->deliverMaterialItemService = $deliverMaterialItemService;
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
        $this->setActionRepository($this->deliverMaterialRepository);
    }

    public function saveDeliverMaterialData(array $data)
    {

        DB::transaction(function () use ($data) {
            $data['user_id'] = Auth::user()->id;
            $save = $this->save($data);
            $this->createDeliverMaterialRequestNotification($save);

            foreach ($data['deliver-material-entries'] as $item) {
                $item['deliver_material_id'] = $save->id;
                $item['status'] = Config::get('constants.cafeteria.status.pending');
                $this->deliverMaterialItemService->save($item);
            }
        });
    }

    public function updateDeliverMaterialData(array $data, $deliverId)
    {
        DB::transaction(function () use ($data, $deliverId) {

            $this->findOrFail($deliverId)->update($data);

            foreach ($data['deliver-material-entries'] as $item) {
                $isItemExist = !empty($item['item_id']) ? $this->deliverMaterialItemService->hasItemInList($item['item_id']) : false;

                if ($isItemExist) {
                    $findItem = $this->deliverMaterialItemService->findOrFail($item['item_id']);
                    $findItem->update($item);
                } else {
                    $item['deliver_material_id'] = $deliverId;
                    $item['status'] = Config::get('constants.cafeteria.status.pending');
                    $this->deliverMaterialItemService->save($item);
                }
            }

            $getAllItemId = collect($data['deliver-material-entries'])->pluck('item_id')->toArray();

            $this->deliverMaterialItemService->deleteIfItemNotInList($deliverId, $getAllItemId);
        });
    }

    public function getDeliveryMaterialFilterData()
    {
        if (Auth::user()->hasAnyRole(Config::get('constants.cafeteria.roles.cafeteria_manager'))) {
            $materials = $this->findAll(null, null, ['column' => 'id', 'direction' => 'DESC']);
        } elseif (Auth::user()->hasAnyRole(Config::get('constants.cafeteria.roles.cafeteria_user'))) {
            $materials = $this->findBy(['user_id' => Auth::user()->id]);
        } else {
            $materials = [];
        }

        return $materials;
    }

    public function approveDeliverMaterialData(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {

            $this->findOrFail($id)->update($data);

            foreach ($data['deliver-material-entries'] as $item) {
                if (!isset($item['status']) || $data['status'] == "rejected") {
                    $item['status'] = Config::get('constants.cafeteria.status.rejected');
                } else {
                    $item['status'] = Config::get('constants.cafeteria.status.approved');
                    $this->updateInventory($data, $item);
                    $this->createDeliverMaterialApprovalNotification($data);
                }

                $isItemExist = !empty($item['item_id']) ? $this->deliverMaterialItemService->hasItemInList($item['item_id']) : false;

                if ($isItemExist) {
                    $findItem = $this->deliverMaterialItemService->findOrFail($item['item_id']);
                    $findItem->update($item);
                } else {
                    $item['deliver_material_id'] = $data['deliver_material_id'];
                    $this->deliverMaterialItemService->save($item);
                }
            }
        });
    }

    public function updateInventory($data, $item)
    {
        /** prepare data for update inventory  and invenotory transactions */
        $data['reference_table'] = Config::get('constants.cafeteria.reference_table.deliver-materials');
        $data['reference_table_id'] = $data['deliver_material_id'];
        $data['status'] = Config::get('constants.cafeteria.status.deliver_material');
        $data['raw_material_id'] = $item['raw_material_id'];
        $data['quantity'] = $item['quantity'];

        $this->cafeteriaInventoryService->deductMaterialAmountFromInventory($data);
    }

    //For Delivery Material Requeest Notification to Cafeteria Maneger


    public function getTypeName(): string
    {
        return NotificationTypeConstant::DELIVERY_MATERIAL_REQUEST;
    }

    public function getTypeDescription(): string
    {
        return self::DELIVERY_MATERIAL_NOTIFICATION_DESCRIPTION;
    }


    public function createDeliverMaterialApprovalNotification($deliverMaterial)
    {
        $deliverMaterial = $this->findOrFail($deliverMaterial['deliver_material_id']);
        $id = $deliverMaterial->user->id;
        $message = trans('cafeteria::deliver-material.deliver-material-approval-notification');
        $url = "deliver-materials.show";
        $this->sendNotification($deliverMaterial, $id, $message, $url);
    }

    public function createDeliverMaterialRequestNotification($deliverMaterial)
    {
        $userRole = 'ROLE_CAFETERIA_MANAGER';
        $message = trans('cafeteria::deliver-material.deliver-material-request-notification');
        $url = "deliver-materials.show";
        $this->DeliverMaterialRequestNotification($deliverMaterial, $userRole, $message, null, $url);
    }

    public function DeliverMaterialRequestNotification($deliverMaterial, $userRole, $message, $users, $url)
    {
        if ($userRole != null) {
            $role = Role::where('name', $userRole)->first();
            $users = $role->users->pluck('id')->toArray();
        }
        foreach ($users as $user) {
            $this->sendNotification($deliverMaterial, $user, $message, $url);
        }
    }

    public function sendNotification(
        $deliverMaterial,
        $toUserId,
        $message,
        $url
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
                'ref_table_id' => $deliverMaterial->id,
                'from_user_id' => Auth::user()->id,
                'to_user_id' => $toUserId,
                'message' => $message,
                'item_url' => route($url, $deliverMaterial->id)
            ]);
        }
    }
}
