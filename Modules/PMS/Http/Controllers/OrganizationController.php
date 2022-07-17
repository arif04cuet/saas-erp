<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\District;
use App\Entities\Division;
use App\Entities\Organization\Organization;
use App\Entities\Thana;
use App\Entities\Union;
use App\Services\AttributeValueService;
use App\Services\DivisionService;
use App\Services\OrganizationService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\LocationService;
use Modules\PMS\Entities\Project;
use Modules\PMS\Http\Requests\StoreOrganizationRequest;
use Modules\PMS\Http\Requests\UpdateOrganizationRequest;

class OrganizationController extends Controller
{
    /**
     * @var OrganizationService
     */
    private $organizationService;
    /**
     * @var AttributeValueService
     */
    private $attributeValueService;
    /**
     * @var DivisionService
     */
    private $divisionService;
    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * OrganizationController constructor.
     * @param OrganizationService $organizationService
     * @param DivisionService $divisionService
     * @param LocationService $locationService
     * @param AttributeValueService $attributeValueService
     */
    public function __construct(
        OrganizationService $organizationService,
        DivisionService $divisionService,
        LocationService $locationService,
        AttributeValueService $attributeValueService
    ) {
        $this->organizationService = $organizationService;
        $this->attributeValueService = $attributeValueService;
        $this->locationService = $locationService;
        $this->divisionService = $divisionService;
    }

    public function create(Project $project)
    {
        $organizableType = Config::get('constants.project');

        $organizationSelectOptions = $this->organizationService->getSelectOptions($project);

        return view('pms::organization.create')->with([
            'organizable' => $project,
            'organizableType' => $organizableType,
            'organizationSelectOptions' => $organizationSelectOptions,
            'divisions' => Division::all()->pluck('name', 'id')
        ]);
    }

    public function show(Project $project, Organization $organization)
    {
        if (!$project->organizations->where('id', $organization->id)->count()) {
            abort(404);
        }

        return view('pms::organization.show', compact(
                'organization',
                'project'
            )
        );
    }

    /*
     * If You are looking for store function
     * Store function is kept global OrganiationController , you can find the route in Global web.php
     */

    public function edit(Project $project, Organization $organization)
    {
        $divisions = $this->locationService->getDivisionsForDropdown();
        $districts = $this->locationService->getDistrictsForDropdown();
        $thanas = $this->locationService->getThanasForDropdown();
        $unions = $this->locationService->getUnionsForDropdown();

        return view('pms::organization.edit',
            compact('divisions', 'districts', 'thanas', 'unions', 'organization', 'project'));

    }

    public function update(UpdateOrganizationRequest $request, Project $project, Organization $organization)
    {
        if ($this->organizationService->update($organization, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('pms-organizations.show', [$project, $organization]);
        } else {
            Session::flash('success', trans('labels.update_fail'));
            return redirect()->route('pms-organizations.show', [$project, $organization]);
        }
    }
}
