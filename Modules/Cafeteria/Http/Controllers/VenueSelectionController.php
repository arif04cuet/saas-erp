<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Entities\VenueSelection;
use Modules\Cafeteria\Services\VenueSelectionService;
use Modules\TMS\Services\TrainingsService;
use Modules\Cafeteria\Services\VenueService;

class VenueSelectionController extends Controller
{

    /**
     * @var $trainingService
     * @var $venueService
     * @var $venueSelectionService
     */

    private $trainingsService;
    private $venueService;
    private $venueSelectionService;

    /**
     * @param TrainingsService $trainingsService 
     * @param VenueService $venueService
     * @param VenueSelectionService $venueSelectionService
    */

    public function __construct(
        TrainingsService $trainingsService,
        VenueService $venueService,
        VenueSelectionService $venueSelectionService
    ) {
        $this->trainingsService = $trainingsService;
        $this->venueService = $venueService;
        $this->venueSelectionService = $venueSelectionService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $venues = $this->venueSelectionService->getDataByDateRange($request);

        return view('cafeteria::venue-selection.index', compact('venues'));
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $trainings = $this->trainingsService->getTrainingsForDropdown();
        $venues = $this->venueService->getVenuesForDropdown();
        $page = "create";

        return view('cafeteria::venue-selection.create', compact('trainings', 'venues', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->venueSelectionService->save($request->all());

        return redirect()->route('venue-selections.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cafeteria::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $trainings = $this->trainingsService->getTrainingsForDropdown();
        $venues = $this->venueService->getVenuesForDropdown();
        $venue = $this->venueSelectionService->findOrFail($id);
        $page = "edit";

        return view('cafeteria::venue-selection.create', compact('venue', 'page', 'trainings', 'venues'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->venueSelectionService->findOrFail($id)->update($request->all());

        return redirect()->route('venue-selections.index')->with('success', __('labels.update_success'));
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
