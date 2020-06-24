<?php

use Illuminate\Support\Facades\Route;

Route::namespace('LaravelEnso\Companies\Http\Controllers')
    ->middleware(['api', 'auth', 'core'])
    ->prefix('api/administration/companies')
    ->as('administration.companies.')
    ->group(function () {
        require 'app/companies.php';
        require 'app/people.php';
    });
