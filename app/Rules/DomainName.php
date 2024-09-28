<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DomainName implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^(http(s)?\:\/\/)?[a-zA-Z0-9]+([\-\.]{1}[a-zA-Z0-9]+)*\.[a-zA-Z]{2,}(\.[a-zA-Z]{1,2})?(\/)?$/', $value);
    }

    public function message()
    {
        return 'The Domain Name must be a valid domain name.';
    }
}
