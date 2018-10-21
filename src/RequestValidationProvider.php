<?php

namespace LaravelEnso\Companies;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyRequest;

class RequestValidationProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(ValidateCompanyRequest::class, function () {
            return config('enso.companies.requestValidator')
                ? $this->app->make(config('enso.companies.requestValidator'))
                : new ValidateCompanyRequest();
        });
    }

    public function provides()
    {
        return [ValidateCompanyRequest::class];
    }
}
