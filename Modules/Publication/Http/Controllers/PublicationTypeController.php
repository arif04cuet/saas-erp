<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\PublicationTypeService;
use Modules\Publication\Http\Requests\PublicationTypeRequest;

class PublicationTypeController extends Controller
{
    private $publicationTypeService;

    public function __construct(PublicationTypeService $publicationTypeService)
    {
        $this->publicationTypeService = $publicationTypeService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $types = $this->publicationTypeService->findAll();
        return view('publication::publication-type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        return view('publication::publication-type.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PublicationTypeRequest $request
     * @return Response
     */
    public function store(PublicationTypeRequest $request)
    {
        $this->publicationTypeService->save($request->all());
        return redirect()->route('publication-types.index')->with('success', __('labels.save_success'));
    }



    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect()->route('publication-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        $page = "edit";
        $types = $this->publicationTypeService->findOrFail($id);
        return view('publication::publication-type.create', compact('types', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param PublicationTypeRequest $request
     * @param int $id
     * @return Response
     */
    public function update(PublicationTypeRequest $request, $id)
    {
        $this->publicationTypeService->findOrFail($id)->update($request->all());
        return redirect()->route('publication-types.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->publicationTypeService->delete($id);
        return redirect()->route('publication-types.index')->with('success', "Deleted Successfully");
    }
}
