<?php

namespace Modules\PMS\Http\Controllers;


use App\Entities\Organization\Organization;
use App\Entities\Organization\OrganizationMember;
use App\Services\AttributeValueService;
use App\Services\OrganizationMemberService;
use App\Services\OrganizationService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;
use Modules\PMS\Http\Requests\StoreUpdateOrgMemberRequest;


class OrganizationMemberController extends Controller
{
    /**
     * @var AttributeValueService
     */
    private $attributeValueService;
    private $organizationService;
    private $organizationMemberService;

    /**
     * OrganizationMemberController constructor.
     * @param AttributeValueService $attributeValueService
     */
    public function __construct(OrganizationService $organizationService, OrganizationMemberService $organizationMemberService, AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
        $this->organizationService = $organizationService;
        $this->organizationMemberService = $organizationMemberService;
    }


    public function create(Project $project, Organization $organization)
    {
        $module = explode('/', Request()->route()->getPrefix())[0];
        return view('pms::organization-member.create', compact('organization', 'module', 'project'));
    }

    public function store(StoreUpdateOrgMemberRequest $request, Organization $organization)
    {
        if ($this->organizationMemberService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('pms-organizations.show', [$request->project_id, $organization->id]);

    }

    public function show(Project $project, Organization $organization, OrganizationMember $member)
    {
        $attributeIds = $project->attributes->pluck('id')->toArray();

        $attributeValues = $this->attributeValueService->getMemberAttributeValues($member->id, $attributeIds);

        return view('pms::organization-member.show', compact(
                'project',
                'organization',
                'member',
                'attributeValues'
            )
        );
    }

    public function edit(Project $project, Organization $organization, OrganizationMember $member)
    {
        $module = explode('/', Request()->route()->getPrefix())[0];
        return view('pms::organization-member.edit', compact('project', 'organization', 'member', 'module'));
    }

    public function update(StoreUpdateOrgMemberRequest $request, Organization $organization, OrganizationMember $member)
    {
        if ($this->organizationMemberService->updateMember($member, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->back();
    }
}
