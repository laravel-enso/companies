<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyStore;

class ValidateCompanyUpdate extends ValidateCompanyStore
{
    protected function nameUnique()
    {
        return parent::nameUnique()
            ->ignore($this->route('company')->id);
    }
}
