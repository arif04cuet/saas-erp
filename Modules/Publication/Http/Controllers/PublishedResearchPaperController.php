<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Publication\Http\Requests\PublishedResearchPaperRequest;
use Modules\Publication\Services\PublicationPressService;
use Modules\Publication\Services\PublicationRequestService;
use Modules\Publication\Services\PublicationTypeService;
use Modules\Publication\Services\PublishedResearchPaperService;

class PublishedResearchPaperController extends Controller
{
    /**
     * @var PublishedResearchPaperService
     */
    private $publishedResearchPaperService;

    /**
     * @var PublicationRequestService
     */
    private $publicationRequestService;

    /**
     * @var PublicationTypeService
     */
    private $publicationTypesService;

    /**
     * @var PublicationPressService
     */
    private $publicationPressService;

    /**
     * PublishedResearchPaperController constructor.
     * @param PublishedResearchPaperService $publishedResearchPaperService
     * @param PublicationRequestService $publicationRequestService
     * @param PublicationTypeService $publicationTypeService
     */

    public function __construct(
        PublishedResearchPaperService $publishedResearchPaperService,
        PublicationRequestService $publicationRequestService,
        PublicationTypeService $publicationTypeService,
        PublicationPressService $publicationPressService
    ) {
        $this->publishedResearchPaperService = $publishedResearchPaperService;
        $this->publicationRequestService = $publicationRequestService;
        $this->publicationTypesService = $publicationTypeService;
        $this->publicationPressService = $publicationPressService;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        $researches = $this->publishedResearchPaperService->getAll();

        return view('publication::published-research-paper.index', compact('researches'));
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
     * @return Factory|Application|View
     */
    public function sendToPressView($id)
    {
        $types = $this->publicationTypesService->getPublicationTypesForDropdown();
        $presses = $this->publicationPressService->getPublicationPressForDropdown();
        $request = $this->publicationRequestService->findOne($id);
        $page = "create";

        return view('publication::published-research-paper.create', compact('page', 'request', 'types', 'presses'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PublishedResearchPaperRequest $request
     * @return RedirectResponse
     */
    public function store(PublishedResearchPaperRequest $request): RedirectResponse
    {
        if (!auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER')) {
            return redirect()->back()->with('error', trans('publication::published-research-paper.unauthorized'));
        }
        $publicationRequest = $this->publishedResearchPaperService->store($request->all());
        $this->publicationRequestService->sendToPressNotification($publicationRequest);
        return redirect()->route('publication.publication-requests')->with('success', trans('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $details = $this->publishedResearchPaperService->findOne($id);
        $remarkLabel = $this->publishedResearchPaperService->getNextProofStatus($details->proof_status);
        $status_for_press = config('publication.status_for_press');
        $status_for_researcher = config('publication.status_for_researcher');

        return view('publication::published-research-paper.show', compact('details', 'remarkLabel', 'status_for_press', 'status_for_researcher'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function proofRequest(Request $request): RedirectResponse
    {
        $this->publishedResearchPaperService->proofRequest($request->all());

        return redirect()->route('publication.published-research-papers.index')->with('success', trans('labels.save_success'));
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
