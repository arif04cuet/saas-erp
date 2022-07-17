<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\EmployeeLoanCircularService;

class EmployeeLoanCircularController extends Controller
{
    /**
     * @var EmployeeLoanCircularService
     */
    private $employeeLoanCircularService;

    /**
     * EmployeeLoanCircularController constructor.
     * @param EmployeeLoanCircularService $employeeLoanCircularService
     */
    public function __construct(EmployeeLoanCircularService $employeeLoanCircularService)
    {
        $this->employeeLoanCircularService = $employeeLoanCircularService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $circulars = $this->employeeLoanCircularService->findAll(null, null,
            [
                'column' => 'id',
                'direction' => 'desc'
            ]);
        return view('hrm::loan.circular.index', compact('circulars'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $page = 'create';
        return view('hrm::loan.circular.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->employeeLoanCircularService->store($request->all())) {
            return redirect()->route('loan-circulars.index')->with('success', __('labels.save_success'));
        } else {
            return redirect()->back()->with('error', __('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $circular = $this->employeeLoanCircularService->findOne($id);
        return view('hrm::loan.circular.show', compact('circular'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $circular = $this->employeeLoanCircularService->findOne($id);
        $page = 'edit';
        return view('hrm::loan.circular.create', compact('circular', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if ($this->employeeLoanCircularService->updateCircular($request->all(), $id)) {
            return redirect()->route('loan-circulars.show', $id)->with('success', __('labels.update_success'));
        } else {
            return redirect()->back()->with('error', __('labels.update_fail'));
        }
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
