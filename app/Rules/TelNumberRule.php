<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TelNumberRule implements Rule
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
        $pattern = "/[0-0]{1}[0-9]{9}/";

        return preg_match($pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง';
    }
}
