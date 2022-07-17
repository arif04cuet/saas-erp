<?php

namespace Modules\Accounts\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Repositories\GpfLoanDepositRepository;
use Modules\Accounts\Services\GpfLoanService;

class GpfLoanDepositController extends Controller
{
    /**
     * @var GpfLoanDepositRepository
     */
    private $gpfLoanDepositRepository;
    /**
     * @var GpfLoanService
     */
    private $gpfLoanService;

    /**
     * GpfLoanDepositController constructor.
     * @param GpfLoanService $gpfLoanService
     * @param GpfLoanDepositRepository $gpfLoanDepositRepository
     */
    public function __construct(
        GpfLoanService $gpfLoanService,
        GpfLoanDepositRepository $gpfLoanDepositRepository
    ) {
        $this->gpfLoanDepositRepository = $gpfLoanDepositRepository;
        $this->gpfLoanService = $gpfLoanService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('accounts::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($loanId)
    {
        $loan = $this->gpfLoanService->findOne($loanId);
        $employee = $loan->employee;
        $page = 'create';
        return view('accounts::gpf.loan.deposit.create', compact('loan', 'employee', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $loanId
     * @return Response
     */
    public function store(Request $request, $loanId)
    {
        DB::transaction(function () use ($request, $loanId) {
            $newLoanBalance = $this->gpfLoanService->deductFromLoan($loanId, $request->amount);
            $data = [
                'gpf_loan_id' => $loanId,
                'amount' => $request->amount,
                'loan_balance' => $newLoanBalance,
                'remarks' => $request->remarks,
                'deposit_date' => Carbon::parse($request->deposit_date)->format('Y-m-d')
            ];
            $save = $this->gpfLoanDepositRepository->save($data);
        });
        Session::flash('success', __('labels.save_success'));

        return redirect(route('gpf-loans.show', $loanId));
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
