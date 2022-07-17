<?php

namespace Modules\RMS\Http\Controllers;

use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Services\MonthlyUpdateService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\RMS\Entities\Research;

class ResearchMonthlyUpdateController extends Controller
{
    private $module;
    /**
     * @var MonthlyUpdateService
     */
    private $monthlyUpdateService;
    /**
     * @var TaskService
     */
    private $taskService;

    /**
     * ResearchMonthlyUpdateController constructor.
     * @param MonthlyUpdateService $monthlyUpdateService
     * @param TaskService $taskService
     */
    public function __construct(MonthlyUpdateService $monthlyUpdateService, TaskService $taskService)
    {
        $this->module = 'rms';
        $this->monthlyUpdateService = $monthlyUpdateService;
        $this->taskService = $taskService;
    }

    public function create(Research $research)
    {
        $action = route($this->module . '-monthly-updates.store', $research->id);

        return view('monthly-update.create')->with([
            'monthlyUpdatable' => $research,
            'module' => $this->module,
            'action' => $action,
        ]);
    }

    public function store(Request $request, Research $research)
    {
        if ($this->monthlyUpdateService->store($research, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('research.show', $research->id);
    }

    public function show(Research $research, MonthlyUpdate $monthlyUpdate)
    {
        $tasks = $this->taskService->findIn('id', explode(', ', $monthlyUpdate->tasks));
        return view('monthly-update.show')->with([
            'module' => $this->module,
            'monthlyUpdatable' => $research,
            'monthlyUpdate' => $monthlyUpdate,
            'tasks' => $tasks
        ]);
    }

    public function edit(Research $research, MonthlyUpdate $monthlyUpdate)
    {
        $action = route($this->module . '-monthly-updates.update', [$research->id, $monthlyUpdate->id]);

        return view('monthly-update.edit')->with([
            'module' => $this->module,
            'action' => $action,
            'monthlyUpdatable' => $research,
            'monthlyUpdate' => $monthlyUpdate,
        ]);
    }

    public function update(Request $request, Research $research, MonthlyUpdate $monthlyUpdate)
    {
        if ($this->monthlyUpdateService->updateEntry($monthlyUpdate, $research, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('research.show', $research->id);
    }
}
