<?php

namespace LaravelEnso\Companies;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Companies\app\Contracts\ValidatesCompanyRequest;
use LaravelEnso\Companies\app\Contracts\ValidatesContactRequest;
use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyRequest;
use LaravelEnso\Companies\app\Http\Requests\ValidateContactRequest;

class RequestValidationProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            ValidatesCompanyRequest::class, ValidateCompanyRequest::class
        );

        $this->app->bind(
            ValidatesContactRequest::class, ValidateContactRequest::class
        );
    }
}
