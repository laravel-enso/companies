<?php

use Illuminate\Support\Facades\Route;

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
