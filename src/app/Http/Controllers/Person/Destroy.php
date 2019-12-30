<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Exceptions\Company as Exception;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\People\App\Models\Person;

class Destroy extends Controller
{
    public function __invoke(Company $company, Person $person)
    {
        if (optional($company->mandatary())->id === $person->id
            && $company->people()->exists()) {
            throw Exception::dissociateMandatary();
        }

        $person->companies()->detach($company->id);
    }
}
