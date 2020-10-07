<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Companies\Http\Controllers\Person\Create;
use LaravelEnso\Companies\Http\Controllers\Person\Destroy;
use LaravelEnso\Companies\Http\Controllers\Person\Edit;
use LaravelEnso\Companies\Http\Controllers\Person\Index;
use LaravelEnso\Companies\Http\Controllers\Person\Store;
use LaravelEnso\Companies\Http\Controllers\Person\Update;

Route::prefix('people')
    ->as('people.')
    ->group(function () {
        Route::get('{company}', Index::class)->name('index');
        Route::get('{company}/create', Create::class)->name('create');
        Route::get('{company}/{person}/edit', Edit::class)->name('edit');
        Route::patch('{person}', Update::class)->name('update');
        Route::post('', Store::class)->name('store');
        Route::delete('{company}/{person}', Destroy::class)->name('destroy');
    });
