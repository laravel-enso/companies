<?php

namespace LaravelEnso\Companies\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Forms\Builders\PersonForm;
use LaravelEnso\Companies\Models\Company;

class Create extends Controller
{
    public function __invoke(Company $company, PersonForm $form)
    {
        return ['form' => $form->create($company)];
    }
}
