<?php

namespace LaravelEnso\Companies\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Tables\Builders\CompanyTable;
use LaravelEnso\Tables\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = CompanyTable::class;
}
