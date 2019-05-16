<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Forms\Builders\PersonForm;

class Create extends Controller
{
    public function __invoke(Company $company, PersonForm $form)
    {
        return ['form' => $form->create($company)];
    }
}
