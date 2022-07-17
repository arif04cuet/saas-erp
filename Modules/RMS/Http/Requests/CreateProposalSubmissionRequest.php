<?php

    namespace Modules\RMS\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Http\Request;

    class CreateProposalSubmissionRequest extends FormRequest
    {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(Request $request)
        {
            return [
                'title' => 'required|max:100',
                'attachment.*' => [
                    'required|max:3072',
                    function ($attribute, $value, $fail) use ($request) {
                        $fileExt = $request->file($attribute)->getClientOriginalExtension();
                        if (!in_array($fileExt, ['jpeg', 'png', 'jpg', 'gif', 'svg', 'doc', 'pdf', 'docx', 'csv', 'xls', 'xlsx'])) {
                            $fail($attribute . ' ' . trans('labels.invalid file type'));
                        }
                    },
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
