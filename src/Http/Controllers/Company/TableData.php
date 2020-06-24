<?php

namespace LaravelEnso\Companies\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Tables\Builders\CompanyTable;
use LaravelEnso\Tables\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected $tableClass = CompanyTable::class;
}
