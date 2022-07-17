<?php

namespace Modules\TMS\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Modules\TMS\Entities\TrainingYear;
use Illuminate\Support\Facades\Auth;
use Modules\TMS\Http\Requests\TrainingYearRequest;
use Modules\TMS\Services\TrainingYearService;
use Illuminate\Support\Facades\Session;

class TrainingYearController extends Controller
{
    /**
     * @var TrainingYearService
     */
    private $trainingYearService;


    public function __construct(
        TrainingYearService $trainingYearService
    ) {
        $this->trainingYearService = $trainingYearService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $trainingYears = $this->trainingYearService->findAll(
            null,
            null,
            ['column' => 'created_at', 'direction' => 'asc']
        );

        return view('tms::training-year.index', compact('trainingYears'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        return view('tms::training-year.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param TrainingYearRequest $trainingYearRequest
     * @return RedirectResponse
     */
    public function store(TrainingYearRequest $trainingYearRequest)
    {
        if ($this->trainingYearService->store($trainingYearRequest->all())) {
            return redirect()->route('training-year.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('training-year.index')->with(
                'error',
                trans('labels.save_fail')
            );
        }
    }

    /**
     * Show the specified resource.
     * @param TrainingYear $trainingYear
     * @return Factory|Application|Response|View
     */
    public function show($id)
    {
        // $trainingYears = $this->trainingYearService->getTrainingYear($trainingYear);
        $trainingYear = $this->trainingYearService->find($id);
        return view('tms::training-year.show', compact('trainingYear'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param TrainingHead $trainingHead
     * @return Factory|Application|Response|View
     */
    public function edit($id)
    {
        $trainingYear = $this->trainingYearService->find($id);
        return view('tms::training-year.edit', compact('trainingYear'));
    }

    /**
     * Update the specified resource in storage.
     * @param TrainingHeadRequest $request
     * @param TrainingHead $trainingHead
     * @return RedirectResponse
     */
    public function update(TrainingYearRequest $request, $id)
    {
        $this->trainingYearService->update($id, $request);
        return redirect()->route('training-year.index')->with('success', trans('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param TrainingHead $trainingType
     * @return void
     */
    public function destroy($id)
    {
        $response = $this->trainingYearService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('training-year.index');
    }
}
