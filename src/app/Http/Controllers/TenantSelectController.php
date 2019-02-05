<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Select\app\Traits\OptionsBuilder;
use LaravelEnso\Multitenancy\app\Classes\Connections;

class TenantSelectController extends Controller
{
    use OptionsBuilder;

    public function query(Request $request)
    {
        return Company::on(Connections::System)
            ->whereIsTenant(true);
    }
}
