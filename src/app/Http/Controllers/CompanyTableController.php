<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\Companies\app\Tables\Builders\CompanyTable;

class CompanyTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = CompanyTable::class;
}
