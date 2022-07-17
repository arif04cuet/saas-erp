<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Http\Requests\PayscaleRequest;
use Modules\Accounts\Services\PayscaleService;
use function Sodium\compare;

class PayscaleController extends Controller
{
    private $payscaleService;

    public function __construct(PayscaleService $payscaleService)
    {
        $this->payscaleService = $payscaleService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $payscales = $this->payscaleService->findAll();
        return view('accounts::payroll.payscale.index', compact('payscales'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        for($count = 1 ; $count<=20; $count++)
        {
            $grades[] = "Grade ".$count;
        }
        $page = 'create';

        return view('accounts::payroll.payscale.create', compact('grades', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PayscaleRequest $request)
    {
        $save = $this->payscaleService->saveData($request->all());
        return redirect(route('payscales.index'))->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $payscale = $this->payscaleService->findOne($id);
        $salaryBasics = (!is_null($payscale)) ? $payscale->salaryBasics : [];

        return view('accounts::payroll.payscale.show', compact('payscale', 'salaryBasics'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $payscale = $this->payscaleService->findOne($id);
        $grades = (!is_null($payscale)) ? $payscale->salaryBasics : [];
        $page = 'edit';

        return view('accounts::payroll.payscale.create', compact('payscale', 'grades', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->payscaleService->updateData($request->all(), $id);
        Session::flash('success', __('labels.update_success'));

        return redirect(route('payscales.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->payscaleService->delete($id);
        Session::flash('success', __('labels.delete_success'));

        return redirect()->back();
    }

    public function toggleActivation($payscaleId)
    {
        $this->payscaleService->toggleActivation($payscaleId);
        Session::flash('success', __('labels.update_success'));

        return redirect()->back();
    }
}
