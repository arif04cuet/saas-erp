<?php

namespace Modules\RMS\Http\Controllers;

use App\Entities\Organization\Organization;
use App\Services\AttributeValueService;
use App\Services\OrganizationService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Modules\RMS\Entities\Research;

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
     * OrganizationController constructor.
     * @param OrganizationService $organizationService
     * @param AttributeValueService $attributeValueService
     */
    public function __construct(OrganizationService $organizationService, AttributeValueService $attributeValueService)
    {
        $this->organizationService = $organizationService;
        $this->attributeValueService = $attributeValueService;
    }

    public function create(Research $research)
    {

        $organizableType = Config::get('constants.research');

        $organizations = $this->organizationService->getUnmappedOrganizations($research);

        return view('organization.create')->with([
            'organizable' => $research,
            'organizableType' => $organizableType,
            'organizations' => $organizations
        ]);
    }

    public function show(Research $research, Organization $organization)
    {
        if (!$research->organizations->where('id', $organization->id)->count()) {
            abort(404);
        }

        $organizableType = Config::get('constants.research');

        $attributeIds = $organization->attributes->map(function ($attribute) {
            return $attribute->id;
        })->toArray();

        $attributeValues = $this->attributeValueService->findIn('attribute_id', $attributeIds);

        $attributeValueSumsByMonth = $this->attributeValueService->getAttributeValuesSumByMonth($attributeValues);

        return view('organization.show', compact('organization', 'organizableType', 'attributeValueSumsByMonth'));
    }
}
