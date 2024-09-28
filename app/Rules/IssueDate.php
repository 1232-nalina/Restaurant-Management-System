<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IssueDate implements Rule
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
        //dd($issue_date);
        $expiry_date = $value;

        $today = \Carbon\Carbon::today()->format('Y-m-d');
        //dd($today);
        if ($issue_date < $today) {
            $this->errorMessage = 'The issue date cannot be in the past.';
            return false;
        }
        return true;
    }

    public function message()
    {
        return $this->errorMessage;
    }
}
