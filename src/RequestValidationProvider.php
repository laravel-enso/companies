<?php

namespace LaravelEnso\Companies;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Companies\app\Contracts\ValidatesCompanyRequest;
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
        $this->app->bind(ValidatesCompanyRequest::class,
            config('enso.companies.requestValidator')
                ? config('enso.companies.requestValidator')
                : ValidateCompanyRequest::class
        );
    }

    public function provides()
    {
        return [ValidatesCompanyRequest::class];
    }
}
