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

                Route::get('initTable', 'InitTable')->name('initTable');
                Route::get('tableData', 'TableData')->name('tableData');
                Route::get('exportExcel', 'ExportExcel')->name('exportExcel');

                Route::get('options', 'Options')->name('options');
            });

        Route::namespace('Person')
            ->group(function () {
                Route::prefix('people')
                    ->as('people.')
                    ->group(function () {
                        Route::get('{company}', 'Index')->name('index');
                        Route::get('{company}/create', 'Create')->name('create');
                        Route::get('{company}/{person}/edit', 'Edit')->name('edit');
                        Route::patch('{person}', 'Update')->name('update');
                        Route::post('', 'Store')->name('store');
                        Route::delete('{company}/{person}', 'Destroy')->name('destroy');
                    });
            });
    });
