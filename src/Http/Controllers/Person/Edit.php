<?php

namespace LaravelEnso\Companies\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Forms\Builders\Person as Form;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\People\Models\Person;

class Edit extends Controller
{
    public function __invoke(Company $company, Person $person, Form $form)
    {
        return ['form' => $form->company($company)->edit($person)];
    }
}
