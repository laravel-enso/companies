<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Person;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Exceptions\Company as Exception;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\People\App\Models\Person;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Company $company, Person $person)
    {
        $this->authorize('manage-people', $company);

        if (optional($company->mandatary())->id === $person->id
            && $company->people()->exists()) {
            throw Exception::dissociateMandatary();
        }

        $person->companies()->detach($company->id);
    }
}
