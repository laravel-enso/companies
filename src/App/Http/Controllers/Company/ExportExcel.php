<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Tables\Builders\CompanyTable;
use LaravelEnso\Tables\App\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = CompanyTable::class;
}
