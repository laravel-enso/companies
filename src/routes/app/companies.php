<?php

use Illuminate\Support\Facades\Route;

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
