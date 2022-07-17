<?php

namespace Modules\IMS\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Modules\IMS\Services\AuctionService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StoreAuctionSaleRequest extends FormRequest
{
    /**
     * @var AuctionService
     */
    private $auctionService;

    /**
     * StoreAuctionSaleRequest constructor.
     * @param AuctionService $auctionService
     */
    public function __construct(AuctionService $auctionService)
    {
        $this->auctionService = $auctionService;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $auction = $this->auctionService->findOrFail($this->request->get('auction_id'));

        return [
            'vendor_id' => 'required',
            'auction_id' => 'required|exists:auction,id',
            'date' => 'required|date_format:d/m/Y|before_or_equal:' . Carbon::now(),
            'sales.*' => 'required',
            'sales.*.inventory_item_category_id' => 'required_with_all:sales.*|numeric|exists:inventory_item_categories,id',
            'sales.*.quantity' => [
                'required_with_all:sales.*', 'numeric', 'min:1',
                function ($attribute, $value, $fail) use ($auction) {
                    $index = (int)preg_replace('/[^0-9]/', '', $attribute);
                    $inventoryItemCategoryId = $this->request->get('sales')[$index]['inventory_item_category_id'];

                    $auctionItemDetail = $auction->details->where('category_id', $inventoryItemCategoryId)->first();

                    if (is_null($auctionItemDetail)) {
                        Log::error(get_class($this) . ": inventory_item_category_id $inventoryItemCategoryId at 
                        index $index not found in auction details");
                    } else if ($value > $auctionItemDetail->quantity) {
                        $fail("$attribute cannot be greater than auction item quantity");
                    }
                }
            ],
            'sales.*.unit_price' => 'required_with_all:sales.*|numeric|min:1',
            'sales.*.tax' => 'required_with_all:sales.*|numeric|min:1',
            'sales.*.vat' => 'required_with_all:sales.*|numeric|min:1',
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
}
