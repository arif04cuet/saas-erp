<?php

    namespace Modules\Accounts\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;
    use Modules\Accounts\Entities\EconomyHead;
    use Modules\Accounts\Entities\RevenueBudget;
    use Modules\Accounts\Services\EconomyHeadService;
    use Modules\Accounts\Services\RevenueBudgetService;

    class RevenueBudgetController extends Controller
    {

        /**
         * @var RevenueBudgetService
         */
        private $revenueBudgetService;

        /**
         * @var
         */
        private $economyHeadService;

        /**
         * RevenueBudgetController constructor.
         * @param RevenueBudgetService $revenueBudgetService
         */
        public function __construct(
            RevenueBudgetService $revenueBudgetService,
            EconomyHeadService $economyHeadService
        )
        {
            $this->revenueBudgetService = $revenueBudgetService;
            $this->economyHeadService = $economyHeadService;
        }

        /**
         * Display a listing of the resource.
         * @return Response
         */
        public function index()
        {
            $revenueBudgets = $this->revenueBudgetService->getAllRevenueBudgets();
            return view('accounts::revenue-budget.index', compact('revenueBudgets'));
        }

        /**
         * Show the form for creating a new resource.
         * @return Response
         */
        public function create()
        {
            return view('accounts::create');
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
        public function show(RevenueBudget $revenueBudget)
        {
            $economyHeads = $this->economyHeadService->findAll();
            $revenueEconomyHeads = $this->revenueBudgetService->getRevenueEconomyHeads($economyHeads);
            return view('accounts::revenue-budget.show', compact('revenueBudget', 'revenueEconomyHeads'));
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

        public function detail(RevenueBudget $revenueBudget,EconomyHead $economyHead)
        {
            $revenueEconomyCodes = $this->revenueBudgetService->getRevenueEconomyCodes($economyHead);
            return view('accounts::revenue-budget.details', compact('revenueBudget','economyHead', 'revenueEconomyCodes'));
        }
    }
