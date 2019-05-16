<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Excel;
use LaravelEnso\Tables\app\Traits\Datatable;
use LaravelEnso\Companies\app\Tables\Builders\CompanyTable;

class Table extends Controller
{
    use Datatable, Excel;

    protected $tableClass = CompanyTable::class;
}
