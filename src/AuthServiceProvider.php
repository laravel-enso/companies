<?php

namespace LaravelEnso\Companies;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Companies\Policies\Company as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Company::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
