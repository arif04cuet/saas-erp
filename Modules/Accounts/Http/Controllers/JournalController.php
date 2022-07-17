<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Accounts\Entities\Journal;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\JournalService;
use Modules\Accounts\Services\JournalTypeService;
use Modules\HRM\Services\DepartmentService;

class JournalController extends Controller
{

    private $economyCodeService;
    private $departmentService;
    private $journalService;
    private $journalTypeService;

    public function __construct(
        EconomyCodeService $economyCodeService,
        DepartmentService $departmentService,
        JournalService $journalService,
        JournalTypeService $journalTypeService
    )
    {
        $this->economyCodeService = $economyCodeService;
        $this->departmentService = $departmentService;
        $this->journalService = $journalService;
        $this->journalTypeService = $journalTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $journals = $this->journalService->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);
        return view('accounts::journal.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(null, function ($code) {
            return $code->code;
        }, null, false);
        $departments = $this->departmentService->getDepartmentsForDropdown();
        $journalTypes = $this->journalTypeService->findAll();
        return view('accounts::journal.create', compact('departments', 'economyCodes', 'journalTypes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        if ($this->journalService->save($validatedData)) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('journal.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Journal $journal)
    {
        return view('accounts::journal.show', compact('journal'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Journal $journal)
    {
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(null, function ($economyCode) {
            return $economyCode->code;
        }, null, false);
        $departments = $this->departmentService->getDepartmentsForDropdown();
        $journalTypes = $this->journalTypeService->findAll();
        return view('accounts::journal.edit', compact('journal', 'economyCodes', 'departments', 'journalTypes'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Journal $journal)
    {
        $validatedData = $this->validateRequest($request);

        if ($this->journalService->update($journal, $validatedData)) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('journal.index');
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

    /**
     * Filter and Validate data from request
     * @param Request $request
     * @return array
     */
    private function validateRequest(Request $request)
    {

        $rules = [
            'name' => 'required',
            'debit_account_id' => 'required',
            'credit_account_id' => 'required',
            'type_id' => 'required',
            'department_id' => 'nullable',
        ];

        $messages = [
            'debit_account_id' => 'Debit account field is required',
            'credit_account_id' => 'Credit account field is required',
            'type_id' => 'Type field is required',
        ];

        return Validator::make($request->all(), $rules, $messages)->validate();
    }

    /**
     * @param Journal $journal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Journal $journal)
    {
        return view('accounts::journal.details', compact('journal'));
    }
}
