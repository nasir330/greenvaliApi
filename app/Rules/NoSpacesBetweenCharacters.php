<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;

class NoSpacesBetweenCharacters implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        // Check if the value contains spaces between characters
        return strpos($value, ' ') === false;
    }

    public function message()
    {
        return 'The :attribute cannot contain spaces between characters.';
    }
}
