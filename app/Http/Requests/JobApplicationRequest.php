<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class JobApplicationRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        // Applicant Information
        $validateInfo = [
            'applicant_name' => 'required|max:255',
            'applicant_name_bn' => 'required|max:255',
            'national_id' => 'required_without:birth_certificate_no|max:255',
            'birth_certificate_no' => 'required_without:national_id|max:255',
            'birth_place' => 'required|max:255',
            'birth_date' => "required",
            'father_name' => 'required|max:255',
            'mother_name' => 'required|max:255',
            'mobile' => 'required|digits:11',
            'email' => 'required|email|max:255',
            'nationality' => 'required|max:255',
            'gender' => 'required|max:255',
            'religion' => 'required|max:255',
            'occupation' => 'max:255',
            'extra_qualities' => 'max:1000',
            'bank_draft_no' => 'required|max:255',
            'name_of_bank_branch' => 'required|max:255',
            'payment_date' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg',
            'signature' => 'required|mimes:png,jpg,jpeg'
        ];

        // Validation for Applicant Permanent Address Information
        $validateAddress = [];
        foreach ($request->address_type as $key => $addressType) {
            $address = [
                'care_of.' . $key => 'max:255',
                'road_and_house.' . $key => 'required|max:255',
                'district.' . $key => 'required|max:255',
                'sub_district.' . $key => 'required|max:255',
                'post_office.' . $key => 'required|max:255',
                'post_code.' . $key => 'required|max:255',
            ];
            $validateAddress = array_merge($validateAddress, $address);
        }

        // Validation for Applicant Education Information
        $validateEducation = [];
        foreach ($request->education_information as $key => $educationLevel) {
            $education = [
                'exam_name.' => 'nullable|max:255',
                'subject.' => 'nullable|max:255',
                'roll.' => 'nullable|numeric',
                'course_duration.' => 'nullable|numeric',
                'board_or_university.' => 'nullable|max:255',
                'grade.' => 'nullable|max:20',
                'passing_year.' => 'nullable|numeric|digits:4',
            ];

            $validateEducation = array_merge($validateEducation, $education);
        }

        // Validation Experience
        $validationExperience = [];
        foreach($request->experience_information as $experienceData) {
            $experience = [
                'organization_name' => 'nullable|max:255',
                'desgination' => 'nullable|max:255',
                'length_of_service' => 'nullable|max:255',
                'responsibilities' => 'nullable|max:255'
            ];

            $validationExperience = array_merge($validationExperience, $experience);
        }

        return array_merge($validateInfo, $validateAddress, $validateEducation, $validationExperience);
    }
}
