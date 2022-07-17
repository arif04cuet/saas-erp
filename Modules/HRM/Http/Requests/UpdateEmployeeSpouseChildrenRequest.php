<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateEmployeeSpouseChildrenRequest extends FormRequest
{
    protected $errorBag = "spouseChildrenError";

    /**
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $this->redirect = 'hrm/employee/' . $request->employee_id . '/edit#spouse-children';

        return [
            'children.*.date_of_birth' => 'required',
        ];
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
}
