<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Forms\Builders\CompanyForm;
use LaravelEnso\Companies\app\Models\Company;

class Edit extends Controller
{
    public function __invoke(Company $company, CompanyForm $form)
    {
        return ['form' => $form->edit($company)];
    }
}
