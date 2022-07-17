<?php
namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingCourseObjectiveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|max:500',
            'specific_points.*.content' => 'required|max:100'
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
