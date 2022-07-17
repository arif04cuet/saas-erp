<?php
namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingVenueRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title' => 'required|max:500',
            'title_bn' => 'required|max:500',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

            'title.required' => trans('tms::venue.msg.requied'),
            'title.max' => trans('tms::venue.msg.max'),

            'title_bn.required' => trans('tms::venue.msg.requied'),
            'title_bn.max' => trans('tms::venue.msg.max'),

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
