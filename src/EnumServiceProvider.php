<?php

namespace LaravelEnso\Companies;

use LaravelEnso\Companies\Enums\Statuses;
use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'companyStatuses' => Statuses::class,
    ];
}
