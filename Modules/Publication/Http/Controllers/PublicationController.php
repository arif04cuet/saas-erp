<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\PublicationRequestService;
use Modules\Publication\Services\PublishedResearchPaperService;
use Modules\Publication\Services\ResearchPaperFreeRequestService;
use Modules\Publication\Services\PublicationPressService;
use Illuminate\Support\Facades\Auth;


class PublicationController extends Controller
{
    private $dashboardService;

    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct(

        PublicationRequestService $publicationRequestService,
        PublishedResearchPaperService $publishedResearchPaperService,
        ResearchPaperFreeRequestService $researchPaperFreeRequestService,
        PublicationPressService $publicationPressService
    ) {

        $this->publicationRequestService = $publicationRequestService;
        $this->publishedResearchPaperService = $publishedResearchPaperService;
        $this->researchPaperFreeRequestService = $researchPaperFreeRequestService;
        $this->publicationPressService = $publicationPressService;
    }


    public function index()
    {

        if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_COMMITTEE')) {
            $publicationRequests = $this->publicationRequestService->findBy(['status' => 'pending']);
        } elseif (auth()->user()->hasAnyRole("ROLE_PUBLICATION_SECTION_OFFICER")) {
            $publicationRequests = $this->publicationRequestService->findBy(['status' => 'approved']);
        } else {
            $publicationRequests = "";
        }

        $userId = Auth::id();
        $publicationsOnPress =  $this->publishedResearchPaperService->getResearchPaperForPressUser($userId);
        $publicationsOnResearcher =  $this->publishedResearchPaperService->getResearchPaperForResearcher($userId);
        $researchPaperRequests = $this->researchPaperFreeRequestService->findBy(['status' => 'pending']);

        return view('publication::index', compact(
            'publicationRequests',
            'publicationsOnPress',
            'publicationsOnResearcher',
            'researchPaperRequests'
        ));
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
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('publication::show');
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
