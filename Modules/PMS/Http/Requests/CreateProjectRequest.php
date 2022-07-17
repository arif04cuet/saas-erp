<?php

namespace Modules\PMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'budget' => 'required',
            'duration' => 'required',
            'ignore_workflow' => 'nullable',
            'fund_source' => 'sometimes|required',
            'project_director_id' => 'nullable',
            'project_sub_director_id' => 'nullable',
            'project_detail_proposal_id' => 'sometimes|required'
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
