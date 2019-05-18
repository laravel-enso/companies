<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Init;
use LaravelEnso\Companies\app\Tables\Builders\CompanyTable;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = CompanyTable::class;
}
