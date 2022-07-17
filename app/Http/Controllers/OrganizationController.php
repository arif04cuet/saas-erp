<?php

namespace App\Http\Controllers;

use App\Entities\Organization\Organization;
use App\Services\OrganizationService;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;
use Modules\PMS\Http\Requests\StoreOrganizationRequest;

class OrganizationController extends Controller
{
    /**
     * @var OrganizationService
     */
    private $organizationService;

    /**
     * OrganizationController constructor.
     * @param OrganizationService $organizationService
     */
    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function store(StoreOrganizationRequest $request)
    {
        if ($this->organizationService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        $redirectUrl = url()->previous();
        $redirectUrl = str_replace('organizations/create', '', $redirectUrl);

        return redirect($redirectUrl);
    }

    public function show(Organization $organization, Project $project)
    {
        $module = 'pms';
        return view('organization.show', compact('organization', 'project', 'module' ));
    }
}
