<?php

namespace Modules\TMS\Http\Controllers;

use App\Models\Doptor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\TrainingVenue;
use Modules\TMS\Services\TrainingVenueService;
use Modules\TMS\Http\Requests\TrainingVenueRequest;

class TrainingVenueController extends Controller
{
    private $trainingVenueService;

    public function __construct(TrainingVenueService $trainingVenueService)
    {
        $this->trainingVenueService = $trainingVenueService;
        // $this->authorizeResource(TrainingVenue::class);
    }

    public function index()
    {
        $venues = $this->trainingVenueService->index();
        return view('tms::venue.index', compact('venues'));
    }


    public function create()
    {
        return view('tms::venue.create');
    }

    public function store(TrainingVenueRequest $request)
    {
        $this->trainingVenueService->store($request);
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('venue.index');
    }

    public function show($id)
    {
        $venue = $this->trainingVenueService->find($id);
        return view('tms::venue.show', compact('venue'));
    }

    public function edit($id)
    {
        // $this->authorize('update');
        $doptors = $this->trainingVenueService->pluck();
        $venue = $this->trainingVenueService->find($id);
        return view('tms::venue.edit', compact('venue', 'doptors'));
    }

    public function update(TrainingVenueRequest $request, $id)
    {
        // $this->authorize('update');
        $this->trainingVenueService->update($id, $request);
        Session::flash('success', trans('labels.update_success'));
        return redirect()->route('venue.index');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->trainingVenueService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('venue.index');
    }
}
