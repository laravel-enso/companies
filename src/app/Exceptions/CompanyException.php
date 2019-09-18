<?php

namespace LaravelEnso\Companies\app\Exceptions;

use LaravelEnso\Helpers\app\Exceptions\EnsoException;

class CompanyException extends EnsoException
{
    public static function dissociateMandatary()
    {
        return new static(__('You cannot dissociate the mandatary unless is the only one attached on this company'));
    }
}
