<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\Attribute;
use App\Entities\Organization\Organization;
use App\Entities\Organization\OrganizationMember;
use App\Services\AttributeService;
use Illuminate\Routing\Controller;
use Modules\PMS\Entities\Project;

class MemberAttributeController extends Controller
{
    /**
     * @var AttributeService
     */
    private $attributeService;

    /**
     * MemberAttributeController constructor.
     * @param AttributeService $attributeService
     */
    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function show(Project $project, Organization $organization, OrganizationMember $member, Attribute $attribute)
    {
        $attributeType = $this->attributeService->getAttributeType($attribute);
        $attributeValue = $this->attributeService->getMemberAttributeValues($attribute, $member);

        return view('pms::member-attribute.show', compact(
                'project',
                'organization',
                'member',
                'attribute',
                'attributeType',
                'attributeValue'
            )
        );
    }
}
