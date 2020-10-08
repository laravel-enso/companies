<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Companies\Http\Controllers\Company\Create;
use LaravelEnso\Companies\Http\Controllers\Company\Destroy;
use LaravelEnso\Companies\Http\Controllers\Company\Edit;
use LaravelEnso\Companies\Http\Controllers\Company\ExportExcel;
use LaravelEnso\Companies\Http\Controllers\Company\InitTable;
use LaravelEnso\Companies\Http\Controllers\Company\Options;
use LaravelEnso\Companies\Http\Controllers\Company\Store;
use LaravelEnso\Companies\Http\Controllers\Company\TableData;
use LaravelEnso\Companies\Http\Controllers\Company\Update;

Route::get('create', Create::class)->name('create');
Route::post('', Store::class)->name('store');
Route::get('{company}/edit', Edit::class)->name('edit');
Route::patch('{company}', Update::class)->name('update');
Route::delete('{company}', Destroy::class)->name('destroy');

Route::get('initTable', InitTable::class)->name('initTable');
Route::get('tableData', TableData::class)->name('tableData');
Route::get('exportExcel', ExportExcel::class)->name('exportExcel');

Route::get('options', Options::class)->name('options');
