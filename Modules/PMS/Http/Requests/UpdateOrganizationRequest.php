<?php

namespace Modules\PMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateOrganizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $validationRules = [
            'name' => 'nullable|unique:organizations,name,' . $this->organization->id,
            'address' => 'max:100',
            'mobile' => 'max:11',
            'email' => 'nullable|unique:organizations,email,' . $this->organization->id,
        ];

        if ($request->hasAny(['union_id', 'thana_id', 'district_id', 'division_id'])) {
            $validationRules = $this->getAddressValidationRules($request, $validationRules);
        }

        return $validationRules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Request $request
     * @param $validationRules
     * @return null|string
     */
    private function getAddressValidationRules(Request $request, $validationRules)
    {
        return array_merge($validationRules, [
            'thana_id' => 'required|exists:thanas,id',
            'union_id' => 'required|exists:unions,id',
            'district_id' => 'required|exists:districts,id',
            'division_id' => 'required|exists:divisions,id',
        ]);
    }
}
