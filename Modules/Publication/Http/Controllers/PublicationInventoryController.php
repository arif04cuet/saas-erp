<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\PublicationInventoryService;
use Modules\Publication\Services\PublicationInventoryTransactionService;
use Modules\Publication\Http\Requests\PublicationInventoryRequest;
use Modules\Publication\Services\PublishedResearchPaperService;

class PublicationInventoryController extends Controller
{
    private $publicationInventoryService;
    private $publishedResearchPaperService;

    public function __construct(
        PublicationInventoryService $publicationInventoryService,
        PublicationInventoryTransactionService $publicationInventoryTransactionService,
        PublishedResearchPaperService $publishedResearchPaperService

    ) {
        $this->publicationInventoryService = $publicationInventoryService;
        $this->publicationInventoryTransactionService = $publicationInventoryTransactionService;
        $this->publishedResearchPaperService = $publishedResearchPaperService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $inventories = $this->publicationInventoryService->findAll();
        return view('publication::publication-inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $researches = $this->publishedResearchPaperService->getAllCompleted();
        $page = "create";
        return view('publication::publication-inventory.create', compact('page', 'researches'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PublicationInventoryRequest $request
     * @return Response
     */
    public function store(PublicationInventoryRequest $request)
    {
        $this->publicationInventoryService->storeInInventory($request->all());
        return redirect()->route('publication-inventories.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $itemDetails = $this->publicationInventoryService->findOrFail($id);
        $transactions = $this->publicationInventoryTransactionService
            ->findBy(
                ['publication_inventory_id' => $id],
                null,
                ['column' => 'id', 'direction' => 'desc']
            );
        return view('publication::publication-inventory.show', compact('itemDetails', 'transactions'));
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
