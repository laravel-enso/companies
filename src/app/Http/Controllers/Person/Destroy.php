<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Exceptions\CompanyException;
use LaravelEnso\Companies\app\Exceptions\CompanyMandataryException;

class Destroy extends Controller
{
    public function __invoke(Company $company, Person $person)
    {
        if (optional($company->mandatary())->id === $person->id
            && $company->people()->exists()) {
            throw CompanyException::dissociateMandatary();
        }

        $person->companies()->detach($company->id);
    }
}
