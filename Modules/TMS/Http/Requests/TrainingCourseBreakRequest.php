<?php

namespace Modules\TMS\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TrainingCourseBreakRequest extends FormRequest
{
    const VALID_TIME_FORMAT = 'h:i A';
    const COMMON_RULE = 'nullable|date_format:' . self::VALID_TIME_FORMAT;
    const CAFETERIA_EXISTS_VALIDATION = "exists:training_cafeterias,id";

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        $midnight = $this->getMidnightTime();
//
//        $cafeteriaServiceStartTime = $this->getCafeteriaServiceStartTime();
//
//        $rules = array();
//
//        $breakfastRules = [
//            'breakfast.start_time' => self::COMMON_RULE . "|after_or_equal:$cafeteriaServiceStartTime",
//            'breakfast.end_time' => $this->getEndTimeValidationFor('breakfast'),
//            'breakfast.training_cafeteria_id' => $this->getCafeteriaValidationRulesFor('breakfast')
//        ];
//
//        $lunchRules = [
//            'lunch.start_time' => self::COMMON_RULE . "|after:breakfast.end_time",
//            'lunch.end_time' => $this->getEndTimeValidationFor('lunch'),
//            'lunch.training_cafeteria_id' => $this->getCafeteriaValidationRulesFor('lunch')
//        ];
//
//        $teaBreakRules = [
//            'tea_break.start_time' => self::COMMON_RULE . "|after:lunch.end_time",
//            'tea_break.end_time' => $this->getEndTimeValidationFor('tea_break'),
//            'tea_break.training_cafeteria_id' => $this->getCafeteriaValidationRulesFor('tea_break')
//        ];
//
//        $dinnerRules = [
//            'dinner.start_time' => self::COMMON_RULE . "|after:tea_break.end_time",
//            'dinner.end_time' => $this->getEndTimeValidationFor('dinner') . "|before:$midnight",
//            'dinner.training_cafeteria_id' => $this->getCafeteriaValidationRulesFor('dinner')
//        ];
//
//        $rules = array_merge($rules, $breakfastRules);
//        $rules = array_merge($rules, $lunchRules);
//        $rules = array_merge($rules, $teaBreakRules);
//        $rules = array_merge($rules, $dinnerRules);
//
//        return $rules;

        return [
            'recurring_schedules.*.title' => 'required|max:255',
            'recurring_schedules.*.start_time' => 'required|date_format:h:i A',
            'recurring_schedules.*.end_time' => 'required|date_format:h:i A',
            'recurring_schedules.*.entity_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'recurring_schedules.*.title' => trans('labels.This field is required'),
            'recurring_schedules.*.start_time.required' => trans('labels.This field is required'),
            'recurring_schedules.*.start_time.date_format' => trans('labels.wrong_format'),
            'recurring_schedules.*.end_time.required' => trans('labels.This field is required'),
            'recurring_schedules.*.end_time.date_format' => trans('labels.wrong_format'),
            'recurring_schedules.*.entity_id' => trans('labels.This field is required'),
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

    /**
     * @param $key
     * @return string
     */
    private function getCafeteriaValidationRulesFor($key): string
    {
        return "nullable|required_with_all:$key.start_time,$key.end_time|" . self::CAFETERIA_EXISTS_VALIDATION;
    }

    /**
     * @return string
     */
    private function getMidnightTime(): string
    {
        $midnight = Carbon::today('Asia/Dhaka')
            ->setTime(23, 59)
            ->format('h:i A');
        return $midnight;
    }

    /**
     * @return string
     */
    private function getCafeteriaServiceStartTime(): string
    {
        $cafeFirstServiceHour = Carbon::today()
            ->setTime(8, 0)
            ->format('h:i A');
        return $cafeFirstServiceHour;
    }

    /**
     * @param $key
     * @return string
     */
    private function getEndTimeValidationFor($key): string
    {
        return self::COMMON_RULE . "|required_with:$key.start_time|after:$key.start_time";
    }
}
