<?php

Route::namespace('LaravelEnso\Companies\app\Http\Controllers')
    ->middleware(['web', 'auth', 'core'])
    ->prefix('api/administration/companies')
    ->as('administration.companies.')
    ->group(function () {
        require 'app/companies.php';
        require 'app/people.php';
    });
