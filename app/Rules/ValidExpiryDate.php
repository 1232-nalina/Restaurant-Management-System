<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidExpiryDate implements Rule
{
    protected $data;
    protected $errorMessage;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function passes($attribute, $value)
    {
        $issue_date = $this->data['issue_date'];
        $expiry_date = $value;

        // Validate that the expiry date is not older than the issue date
        // if ($expiry_date < $issue_date) {
        //     $this->errorMessage = 'The expiry date cannot be older than the issue date.';
        //     return false;
        // }

        // Validate that the expiry date is greater than 6 months or 1 year
        $min_expiry_date = Carbon::parse($issue_date)->addYear()->subDay(); // Change 6 to 12 if you want to check for 1 year
        if ($expiry_date >= $min_expiry_date) {
            // Expiry date is greater than or equal to 1 year from issue date
            // Proceed with your code here
            return true;
        } else {
            $this->errorMessage = 'The expiry date must be greater than 1 year from the issue date.';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->errorMessage;
    }
}
