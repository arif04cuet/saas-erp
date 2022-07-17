<?php

namespace Modules\IMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\IMS\Constants\InventoryRequestType;
use Modules\IMS\Entities\InventoryRequest;
use Modules\IMS\Services\InventoryService;

class CreateInventoryRequestPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param InventoryService $inventoryService
     * @return array
     */
    public function rules(InventoryService $inventoryService)
    {

        $rules = [
            'category' => $this->type === InventoryRequestType::REQUISITION
                ? 'required_without_all:new-category,bought-category|array|min:1'
                : 'required|array|min:1',
            'new-category' => $this->type === InventoryRequestType::REQUISITION
                ? 'required_without_all:category,bought-category|array|min:1'
                : '',
            'bought-category' => $this->type === InventoryRequestType::REQUISITION
                ? 'required_without_all:category,new-category|array|min:1'
                : '',
        ];

        $rules = $this->checkQuantityForTransfer($inventoryService, $rules);

        return $rules;
    }

    public function messages()
    {
        return [
            'category.min:1' => trans('ims::inventory.category') . ' ' . trans('labels.add'),
            'category.required' => trans('ims::inventory.category') . ' ' . trans('labels.add'),
            'category.required_without_all' => trans('validation.required_without_all',
                [
                    'attribute' => trans('ims::inventory.category'),
                    'values' => trans('ims::inventory.bought-category') . "/" . trans('ims::inventory.new-category')
                ]
            ),
            'new-category.min:1' => trans('ims::inventory.new-category') . ' ' . trans('labels.add'),
            'new-category.required_without_all' => trans('validation.required_without_all',
                [
                    'attribute' => trans('ims::inventory.new-category'),
                    'values' => trans('ims::inventory.category') . "/" . trans('ims::inventory.bought-category')
                ]
            ),
            'bought-category.min:1' => trans('ims::inventory.bought-category') . ' ' . trans('labels.add'),
            'bought-category.required_without_all' => trans('validation.required_without_all',
                [
                    'attribute' => trans('ims::inventory.bought-category'),
                    'values' => trans('ims::inventory.category') . "/" . trans('ims::inventory.new-category')
                ]
            ),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param InventoryService $inventoryService
     * @param $rules
     * @return mixed
     */
    private function checkQuantityForTransfer(InventoryService $inventoryService, $rules)
    {
        if ($this->type === InventoryRequestType::TRANSFER) {
            $rules['category.*.quantity'] = [
                'required',
                function ($attribute, $value, $fail) use ($inventoryService) {
                    $index = (int)preg_replace('/[^0-9]/', '', $attribute);
                    $categoryId = intval($this->category[$index]['category_id']);
                    $quantity = floatval($this->category[$index]['quantity']);
                    $fromLocationId = $this->inventoryRequest->from_location_id;

                    $transferableQuantity = $inventoryService->findBy([
                        'location_id' => $fromLocationId,
                        'inventory_item_category_id' => $categoryId
                    ])
                        ->pluck('quantity')
                        ->first();

                    if ($quantity > $transferableQuantity) {
                        $fail(__('ims::inventory.quantity_error'));
                    }
                }
            ];
        }
        return $rules;
    }
}
