<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Http\Resources\Person as Resource;
use LaravelEnso\Companies\app\Models\Company;

class Index extends Controller
{
    public function __invoke(Company $company)
    {
        return Resource::collection($company->people);
    }
}
