<?php

namespace LaravelEnso\Companies;

use LaravelEnso\Addresses\AddressableServiceProvider as ServiceProvider;
use LaravelEnso\Companies\Models\Company;

class AddressableServiceProvider extends ServiceProvider
{
    protected array $register = [
        Company::class,
    ];
}
