<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Forms\Builders\PersonForm;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\People\app\Models\Person;

class Edit extends Controller
{
    public function __invoke(Company $company, Person $person, PersonForm $form)
    {
        return ['form' => $form->company($company)->edit($person)];
    }
}
