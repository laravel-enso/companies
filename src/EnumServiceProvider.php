<?php

namespace LaravelEnso\Companies;

use LaravelEnso\Companies\app\Enums\CompanyStatuses;
use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'companyStatuses' => CompanyStatuses::class,
    ];
}
