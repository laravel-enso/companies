<?php

Route::namespace('LaravelEnso\Companies\app\Http\Controllers')
    ->middleware(['web', 'auth', 'core'])
    ->prefix('api/administration')
    ->as('administration.')
    ->group(function () {
        Route::prefix('companies')->as('companies.')
        ->group(function () {
            Route::get('options', 'CompanySelectController@options')
                ->name('options');

            Route::get('initTable', 'CompanyTableController@init')
                ->name('initTable');
            Route::get('getTableData', 'CompanyTableController@data')
                ->name('getTableData');
            Route::get('exportExcel', 'CompanyTableController@excel')
                ->name('exportExcel');
        });

        Route::resource('companies', 'CompanyController', ['except' => ['index', 'show']]);
    });
