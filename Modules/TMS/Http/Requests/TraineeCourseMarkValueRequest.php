<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\TMS\Entities\TrainingCourseMarkAllotment;
use Symfony\Component\Debug\Debug;

class TraineeCourseMarkValueRequest extends FormRequest
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
            'trainee_id' => 'required|exists:trainees,id',
            'marks.*' => 'required',
            'marks.*.mark_allotment_type_id' => 'required|exists:training_course_mark_allotment_types,id',
            'marks.*.value' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    try {
                        $index = preg_replace('/[^0-9]+/', '', $attribute);

                        $markAllotmentId = $request->input("marks.$index.mark_allotment_id");

                        $markAllotment = TrainingCourseMarkAllotment::findOrFail($markAllotmentId);

                        $title = optional($markAllotment->type)->title;

                        $localizedTitle = trans('tms::mark_allotment_type.' . $title);

                        if ($value < 0) $fail("$localizedTitle cannot be less than 0");

                        if ($value > $markAllotment->mark) {
                            $fail("$localizedTitle cannot be greater than $markAllotment->mark");
                        }
                    } catch (\Exception $exception) {
                        Debug::error(get_class($this) . " " . $exception->getMessage());

                        $fail('Unhandled error caught');
                    }

                },
            ],
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
