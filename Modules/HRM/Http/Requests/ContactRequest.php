<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'first_name'      => 'required|max:255',
                'last_name'       => 'required|max:255',
                'organaization'   => 'required|max:255',
                'designation'     => 'required|max:255',
                'address'         => 'required',
                'contact_type_id' => 'required',
                'mobile_one'      => 'required',
                'email'           => 'unique:contacts,email,' . $id['contact']
            ];
        } else {
            return [
                    'first_name'      => 'required|max:255',
                    'last_name'       => 'required|max:255',
                    'organaization'   => 'required|max:255',
                    'designation'     => 'required|max:255',
                    'address'         => 'required',
                    'contact_type_id' => 'required',
                    'mobile_one'      => 'required',
                    'email'           => 'unique:contacts,email',
                ];
        }
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

     public function messages()
    {
        return [
            'email.unique' => trans('hrm::contact.email_msg'),
        ];
    }

}
