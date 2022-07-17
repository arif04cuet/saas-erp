<?php

namespace Modules\HRM\Rules;

use Illuminate\Contracts\Validation\Rule;

class SalaryRange implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value >= 20010 && $value <= 76490;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('labels.Salary must be in between 20,010 to 76,490');
    }
}
