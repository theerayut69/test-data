<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidTeam implements Rule 
{

    protected $message = "Sorry, home team is not equal to away team.";

    public function passes($attribute, $value)
    {
        $response = $this->getTeamDuplicate($value);
    }

    public function message()
    {
        return $this->message;
    }

    public function getTeamDuplicate()
    {
        dd($this->client);
    }
}