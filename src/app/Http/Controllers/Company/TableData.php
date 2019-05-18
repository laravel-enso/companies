<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Data;
use LaravelEnso\Companies\app\Tables\Builders\CompanyTable;

class TableData extends Controller
{
    use Data;

    protected $tableClass = CompanyTable::class;
}
