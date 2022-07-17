<?php

namespace Modules\TMS\Http\Controllers;

use App\Models\Doptor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\TrainingExpenseType;
use Modules\TMS\Services\TrainingExpenseTypeService;
use Modules\TMS\Http\Requests\TrainingExpenseTypeRequest;

class TrainingExpenseTypeController extends Controller
{
    private $trainingExpenseTypeService;

    public function __construct(TrainingExpenseTypeService $trainingExpenseTypeService)
    {
        $this->trainingExpenseTypeService = $trainingExpenseTypeService;
        // $this->authorizeResource(TrainingExpenseType::class);
    }

    public function index()
    {
        $datas = $this->trainingExpenseTypeService->index();
        return view('tms::expense-type.index', compact('datas'));
    }

    public function create()
    {
        return view('tms::expense-type.create');
    }

    public function store(TrainingExpenseTypeRequest $request)
    {
        $this->trainingExpenseTypeService->store($request);
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('expense-type.index');
    }

    public function show($id)
    {
        $expense_type = $this->trainingExpenseTypeService->find($id);
        return view('tms::expense-type.show', compact('expense_type'));
    }

    public function edit($id)
    {
        // $this->authorize('update');
        $expense_type = $this->trainingExpenseTypeService->find($id);
        return view('tms::expense-type.edit', compact('expense_type'));
    }

    public function update(TrainingExpenseTypeRequest $request, $id)
    {
        // $this->authorize('update');
        $this->trainingExpenseTypeService->update($id, $request);
        Session::flash('success', trans('labels.update_success'));
        return redirect()->route('expense-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->trainingExpenseTypeService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('expense-type.index');
    }
}
