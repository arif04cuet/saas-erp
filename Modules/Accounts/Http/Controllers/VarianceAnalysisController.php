<?php

    namespace Modules\Accounts\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;

    class VarianceAnalysisController extends Controller
    {
        /**
         * Show the variance for a budget
         * @param int $id
         * @return Response
         */
        public function show($id)
        {
            return view('accounts::budget.variance-analysis');
        }
    }
