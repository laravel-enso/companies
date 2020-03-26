<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Forms\Builders\PersonForm;
use LaravelEnso\Companies\App\Models\Company;

class Create extends Controller
{
    public function __invoke(Company $company, PersonForm $form)
    {
        return ['form' => $form->create($company)];
    }
}
