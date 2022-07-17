<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Http\Requests\VenueRequest;
use Modules\Cafeteria\Services\VenueService;

class VenueController extends Controller
{
    private $venueService;

    public function __construct(VenueService $venueService)
    {
        $this->venueService = $venueService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $venues = $this->venueService->findAll();
        return view('cafeteria::venue.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        return view('cafeteria::venue.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(VenueRequest $request)
    {
        $this->venueService->save($request->all());

        return redirect()->route('venues.index')->with('success', __('labels.save_success'));
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
        $venue = $this->venueService->findOrFail($id);
        $page = "edit";

        return view('cafeteria::venue.create', compact('venue', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(VenueRequest $request, $id)
    {
        $this->venueService->findOrFail($id)->update($request->all());

        return redirect()->route('venues.index')->with('success', __('labels.update_success'));
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
