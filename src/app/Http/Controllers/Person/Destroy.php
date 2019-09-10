<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Exceptions\CompanyMandataryException;

class Destroy extends Controller
{
    public function __invoke(Company $company, Person $person)
    {
        if (optional($company->mandatary())->id === $person->id
            && $company->people()->exists()) {
            throw new CompanyMandataryException(__(
                'You cannot dissociate the mandatary unless is the only one attached on this company'
            ));
        }

        $person->companies()->detach($company->id);
    }
}
