<?php

namespace App\Http\Controllers;

use App\Entities\Attribute;
use App\Entities\AttributeValue;
use App\Services\AttributeValueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Http\Requests\UpdateAttributeValueRequest;

class AttributeValueController extends Controller
{
    /**
     * @var AttributeValueService
     */
    private $attributeValueService;

    /**
     * MemberAttributeValueController constructor.
     * @param AttributeValueService $attributeValueService
     */
    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
    }

    public function create(Attribute $attribute)
    {
        $pageType = 'create';
        $module = explode("/", Request()->route()->getPrefix())[0];

        return view('attribute-value.create', compact('attribute', 'pageType', 'module'));
    }

    public function store(Request $request, Attribute $attribute)
    {
        // Checking if a value is already exist for the requested month
        foreach($attribute->values as $value)
        {
            if(date('n', strtotime($value->date)) == date('n', strtotime($request->input('date')))){
                Session::flash('error', trans('attribute.duplicate_value_entry'));
                return redirect()->back();
            }
        }

        if ($this->attributeValueService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->back();
    }

    public function edit(Attribute $attribute, AttributeValue $attributeValue)
    {
        if (!$attribute->values->where('id', $attributeValue->id)->count()) {
            abort(404);
        }

        $module = explode('/', Request()->route()->getPrefix())[0];
        $pageType = 'edit';

        return view('attribute-value.edit', compact('attribute', 'attributeValue', 'pageType', 'module'));
    }

    public function update(UpdateAttributeValueRequest $request, Attribute $attribute, AttributeValue $attributeValue)
    {
        if (!$attribute->values->where('id', $attributeValue->id)->count()) {
            abort(404);
        }

        if ($this->attributeValueService->update($attributeValue, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->back();
    }
}
