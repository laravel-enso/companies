<?php

namespace LaravelEnso\Companies;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Companies\App\Policies\Company as Policy;

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
