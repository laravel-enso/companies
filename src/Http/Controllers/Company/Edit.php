<?php

namespace LaravelEnso\Companies\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Forms\Builders\CompanyForm;
use LaravelEnso\Companies\Models\Company;

class Edit extends Controller
{
    public function __invoke(Company $company, CompanyForm $form)
    {
        return ['form' => $form->edit($company)];
    }
}
