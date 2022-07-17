<?php

namespace Modules\PMS\Http\Requests;

use App\Entities\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreAttributeValueRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'attribute_id' => 'required|exists:attributes,id',
            'date' => 'required|date',
            'transaction_type' => 'required|in:withdraw,deposit',
            'achieved_value' => [
                'required',
                'numeric',
                'min:1',
                function ($input, $value, $fail) use ($request) {
                    $attribute = Attribute::find($request->input('attribute_id'));

                    $isWithdrawTransaction = $request->get('transaction_type') == 'withdraw';

                    if ($isWithdrawTransaction && !is_null($attribute)) {
                        $attribute->values()
                            ->where('organization_member_id', $this->member->id)
                            ->sum('achieved_value') >= $value ?: $fail(trans('labels.achieved value cannot be greater than current balance'));
                    }
                }
            ]
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
