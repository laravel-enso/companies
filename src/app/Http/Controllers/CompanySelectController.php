<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class CompanySelectController extends Controller
{
    use OptionsBuilder;

    public function query(Request $request)
    {
        $query = Company::query();

        if (! $request->user()->belongsToAdminGroup()
            && $request->user()->person->company_id) {
            $query->whereId($request->user()->person->company_id);
        }

        return $query;
    }
}
