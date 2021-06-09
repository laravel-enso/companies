<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/administration/companies')
    ->as('administration.companies.')
    ->group(function () {
        require __DIR__.'/app/companies.php';
        require __DIR__.'/app/people.php';
    });
