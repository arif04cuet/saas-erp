<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateEmployeePublicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $errorBag = "publicationError";

    public function rules(Request $request)
    {
        $this->redirect = '/hrm/employee/' . $request->publication[0]['employee_id'] . '/edit#publication';

        return [
            'publication.*.type_of_publication' => 'required|max:300',
            'publication.*.author_name' => 'required|max:300',
            'publication.*.publication_title' => 'required|max:300',
            'publication.*.publication_company' => 'required|max:300',
            'publication.*.publication_company_location' => 'nullable|max:300',
            'publication.*.published_date' => 'required',
            'publication.*.source_link' => 'required',
        ];
    }

    public function messages()
    {
        $messages = [
            'publication.*.type_of_publication.required' => 'Please enter publication name',
            'publication.*.author_name.required' => 'Please enter author name',
            'publication.*.publication_title.required' => 'Please enter publication title',
            'publication.*.publication_company.required' => 'Please enter publication company',
            'publication.*.published_date.required' => 'Please enter published date',
            'publication.*.source_link.required' => 'Please enter published link',
        ];

        return $messages;
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
