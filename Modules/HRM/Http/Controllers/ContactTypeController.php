<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Http\Requests\ContactTypeRequest;
use Modules\HRM\Services\ContactTypeService;

class ContactTypeController extends Controller
{
    /**
     * @var contactTypeService $contactTypeService
     */

    private $contactTypeService;

    /**
     * @param ContactTypeService $contcatTypeService
     */

    public function __construct(ContactTypeService $contactTypeService)
    {
        $this->contactTypeService = $contactTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $types = $this->contactTypeService->findAll(null, null, ['column' => 'id', 'direction' => 'desc']);

        return view('hrm::contact.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        
        return view('hrm::contact.type.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(ContactTypeRequest $request)
    {
        $this->contactTypeService->save($request->all());

        return redirect()->route('contact-types.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('hrm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $type = $this->contactTypeService->findOrFail($id);
        $page = "edit";

        return view('hrm::contact.type.create', compact('type', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ContactTypeRequest $request, $id)
    {
        $this->contactTypeService->findOrFail($id)->update($request->all());

        return redirect()->route('contact-types.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
