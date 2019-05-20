<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class Options extends Controller
{
    use OptionsBuilder;

    public function query(Request $request)
    {
        return Company::when(
            ! $request->user()->belongsToAdminGroup(),
            function ($query) use ($request) {
                $query->whereIn(
                    'id', $request->user()->person->companies()->pluck('id')
                );
            });
    }
}
