<?php

namespace LaravelEnso\Companies;

use LaravelEnso\Companies\app\Enums\CompanyStatuses;
use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;

class EnumsServiceProvider extends ServiceProvider
{
    protected $register = [
        'companyStatuses' => CompanyStatuses::class,
    ];
}
