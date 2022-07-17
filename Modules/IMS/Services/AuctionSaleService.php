<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 5/21/19
 * Time: 1:47 PM
 */

namespace Modules\IMS\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\IMS\Entities\AuctionSaleDetail;
use Modules\IMS\Repositories\AuctionSaleRepository;

class AuctionSaleService
{
    use CrudTrait;
    /**
     * @var AuctionSaleRepository
     */
    private $auctionSaleRepository;
    private $auctionService;

    /**
     * AuctionSaleService constructor.
     * @param AuctionSaleRepository $auctionSaleRepository
     * @param AuctionService $auctionService
     */
    public function __construct(AuctionSaleRepository $auctionSaleRepository, AuctionService $auctionService)
    {
        $this->auctionService = $auctionService;
        $this->auctionSaleRepository = $auctionSaleRepository;
        $this->setActionRepository($auctionSaleRepository);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
            $data['order_no'] = time();

            $this->updateAuctionDetailsOnSale($data['auction_id'], $data['sales']);

            $auctionSale = $this->save($data);

            $collectionOfAuctionSaleDetails = collect($data['sales']);
            $auctionSaleDetails = $collectionOfAuctionSaleDetails->map(function ($auctionSaleDetail) {
                return new AuctionSaleDetail($auctionSaleDetail);
            });

            return $auctionSale->details()->saveMany($auctionSaleDetails);
        });
    }

    /**
     * @param int $auctionId
     * @param array $sales
     */
    private function updateAuctionDetailsOnSale(int $auctionId, array $sales): void
    {
        $auction = $this->auctionService->findOrFail($auctionId);

        foreach ($sales as $key => $data) {
            $auction->details()
                ->where('category_id', $data['inventory_item_category_id'])
                ->decrement(
                    'quantity', $data['quantity']
                );
        }

    }
}