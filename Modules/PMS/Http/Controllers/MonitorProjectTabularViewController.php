<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\Organization\Organization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PMS\Entities\ProjectProposal;
use Modules\PMS\Services\AttributeValueService;

class MonitorProjectTabularViewController extends Controller
{
    /**
     * @var AttributeValueService
     */
    private $attributeValueService;

    /**
     * MonitorProjectTabularViewController constructor.
     * @param AttributeValueService $attributeValueService
     */
    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
    }

    /**
     * Display a listing of the resource.
     * @param Organization $organization
     * @return Response
     */
    public function index(Organization $organization)
    {
        $attributeIds = $organization->attributes->map(function ($attribute) {
            return $attribute->id;
        })->toArray();

        $attributeValues = $this->attributeValueService->findIn('attribute_id', $attributeIds);

        $attributeValueSumsByMonth = $this->attributeValueService->getAttributeValuesSumByMonth($attributeValues);

        return view('attribute-value.tabular-view', compact('organization', 'attributeValueSumsByMonth'));
    }
}
