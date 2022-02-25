<?php

namespace LaravelEnso\Companies\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Forms\Builders\Person;
use LaravelEnso\Companies\Models\Company;

class Create extends Controller
{
    public function __invoke(Company $company, Person $form)
    {
        return ['form' => $form->create($company)];
    }
}
