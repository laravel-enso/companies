<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Excel;
use LaravelEnso\Companies\app\Tables\Builders\CompanyTable;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = CompanyTable::class;
}
