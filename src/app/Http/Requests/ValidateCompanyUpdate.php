<?php

namespace LaravelEnso\Companies\app\Http\Requests;

class ValidateCompanyUpdate extends ValidateCompanyStore
{
    protected function nameUnique()
    {
        return parent::nameUnique()
            ->ignore($this->route('company')->id);
    }
}
