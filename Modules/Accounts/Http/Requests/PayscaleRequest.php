<?php

namespace Modules\Accounts\Http\Requests;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Foundation\Http\FormRequest;

class PayscaleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'active_from' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => __('validation.lte.numeric', ['attribute' => __('labels.title'),
                'value' => EnToBnNumberConverter::en2bn(100)])
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
