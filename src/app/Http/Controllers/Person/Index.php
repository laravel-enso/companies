<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Http\Resources\Person as Resource;
use LaravelEnso\Companies\App\Models\Company;

class Index extends Controller
{
    public function __invoke(Company $company)
    {
        return Resource::collection($company->people);
    }
}
