<?php

    namespace Modules\Accounts\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;
    use Modules\Accounts\Services\EconomyCodeService;

    class ReceiptAndPaymentController extends Controller
    {
        private $economyCodeService;


        public function __construct(EconomyCodeService $economyCodeService)
        {
            $this->economyCodeService = $economyCodeService;
        }

        /**
         * Display a listing of the resource.
         * @return Response
         */
        public function index()
        {
            return view('accounts::receipt-payment.index');
        }

        /**
         * Show the form for creating a new resource.
         * @return Response
         */
        public function create()
        {
            $economicCodes = $this->economyCodeService->getEconomyCodesForDropdown();
            return view('accounts::receipt-payment.create', compact('economicCodes'));
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Response
         */
        public function show($id)
        {
            return view('accounts::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Response
         */
        public function edit($id)
        {
            return view('accounts::edit');
        }

        /**
         * Update the specified resource in storage.
         * @param Request $request
         * @param int $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         * @param int $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }
    }
