<?php

    namespace Modules\IMS\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Session;
    use Modules\IMS\Entities\Auction;
    use Modules\IMS\Entities\AuctionSale;
    use Modules\IMS\Http\Requests\StoreAuctionSaleRequest;
    use Modules\IMS\Services\AuctionSaleService;
    use Modules\IMS\Services\AuctionService;
    use Modules\IMS\Services\VendorService;

    class AuctionSaleController extends Controller
    {
        private $auctionSaleService;
        private $vendorService;
        /**
         * @var AuctionService
         */
        private $auctionService;

        /**
         * AuctionSaleController constructor.
         * @param AuctionService $auctionService
         * @param AuctionSaleService $auctionSaleService
         * @param VendorService $vendorService
         */
        public function __construct(
            AuctionService $auctionService,
            AuctionSaleService $auctionSaleService,
            VendorService $vendorService
        )
        {
            $this->auctionSaleService = $auctionSaleService;
            $this->vendorService = $vendorService;
            $this->auctionService = $auctionService;
        }

        public function index()
        {
            $auctionSales = $this->auctionSaleService->findAll(
                null,
                null,
                ['column' => 'id', 'direction' => 'desc']
            );

            return view('ims::auction.sale.index', compact('auctionSales'));
        }

        public function create(Auction $auction)
        {
            $vendorDropdownOptions = $this->vendorService->getDropdownOptions();
            $inventoryItemCategoryOptions = $this->auctionService
                ->getAvailableInventoryItemCategoriesOfAuction($auction)
                ->pluck('name', 'id');

            return view('ims::auction.sale.create', compact(
                    'auction',
                    'vendorDropdownOptions',
                    'inventoryItemCategoryOptions'
                )
            );
        }

        public function store(StoreAuctionSaleRequest $request)
        {
            if ($this->auctionSaleService->store($request->all())) {
                Session::flash('success', trans('labels.save_success'));
            } else {
                Session::flash('error', trans('labels.save_fail'));
            }

            return redirect()->route('auctions.sales.index');
        }


        /**
         * Show the specified resource.
         * @param AuctionSale $auctionSale
         * @return Response
         */

        public function show(Auction $auction, AuctionSale $auctionSale)
        {
            return view('ims::auction.sale.show', compact('auction', 'auctionSale'));
        }
    }
