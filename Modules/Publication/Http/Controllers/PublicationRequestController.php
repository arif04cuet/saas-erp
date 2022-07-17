<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\PublicationRequestService;

class PublicationRequestController extends Controller
{
    /**
     * @var PublicationRequestService
     */
    private $publicationRequestService;

    public function __construct(PublicationRequestService $publicationRequestService)
    {
        $this->publicationRequestService = $publicationRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $requests = $this->publicationRequestService->getPublicationRequestsByUser();

        return view('publication::publication-request.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('publication::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $details = $this->publicationRequestService->findOne($id);

        return view('publication::publication-request.details', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('publication::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $publicationRequest = $this->publicationRequestService->updatePublicationRequest($request->all(), $id);
        $this->publicationRequestService->updatePublicationRequestNotification($publicationRequest);
        return redirect()->route('publication.publication-requests')->with('success', trans('publication::publication-request.update_success'));
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
