<?php

namespace LaravelEnso\Companies\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Tables\Builders\CompanyTable;
use LaravelEnso\Tables\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = CompanyTable::class;
}
