<?php

Route::namespace('LaravelEnso\Companies\app\Http\Controllers')
    ->middleware(['web', 'auth', 'core'])
    ->prefix('api/administration/companies')
    ->as('administration.companies.')
    ->group(function () {
        Route::namespace('Company')
            ->group(function () {
                Route::get('create', 'Create')->name('create');
                Route::post('', 'Store')->name('store');
                Route::get('{company}/edit', 'Edit')->name('edit');
                Route::patch('{company}', 'Update')->name('update');
                Route::delete('{company}', 'Destroy')->name('destroy');

                Route::get('initTable', 'Table@init')->name('initTable');
                Route::get('tableData', 'Table@data')->name('tableData');
                Route::get('exportExcel', 'Table@excel')->name('exportExcel');

                Route::get('options', 'Options')->name('options');
            });

        Route::namespace('Person')
            ->group(function () {
                Route::prefix('{company}/people')
                    ->as('people.')
                    ->group(function () {
                        Route::get('', 'Index')->name('index');
                        Route::get('create', 'Create')->name('create');
                    });

                Route::prefix('people')
                    ->as('people.')
                    ->group(function () {
                        Route::get('{person}/edit', 'Edit')->name('edit');
                        Route::patch('{person}', 'Update')->name('update');
                        Route::post('store', 'Store')->name('store');
                        Route::delete('{person}', 'Destroy')->name('destroy');
                    });
            });
    });
