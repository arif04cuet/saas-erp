<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Http\Requests\ContactRequest;
use Modules\HRM\Services\ContactService;
use Modules\HRM\Services\ContactTypeService;

class ContactController extends Controller
{

    /**
     * @var $contactTypeService
     */

    private $contactTypeService;

    /**
     * @var $contactService
     */

    private $contactService;

    /**
     * @param ContactTypeService $contactTypeService
     * @param ContactService $contactService
     */

    public function __construct(
        ContactTypeService $contactTypeService,
        ContactService $contactService
    ) {
        $this->contactTypeService = $contactTypeService;
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $contacts = $this->contactService->findAll();

        return view('hrm::contact.information.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $types = $this->contactTypeService->getContactTypesForDropdown();
        $page = "create";

        return view('hrm::contact.information.create', compact('page', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(ContactRequest $request)
    {
        $this->contactService->save($request->all());

        return redirect()->route('contacts.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('hrm::contact.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactService->findOrFail($id);
        $types = $this->contactTypeService->getContactTypesForDropdown();
        $page = "edit";

        return view('hrm::contact.information.create', compact('page', 'types', 'contact'));

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ContactRequest $request, $id)
    {
        $this->contactService->findOrFail($id)->update($request->all());

        return redirect()->route('contacts.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
