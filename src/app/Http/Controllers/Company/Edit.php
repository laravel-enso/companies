<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Forms\Builders\CompanyForm;
use LaravelEnso\Companies\App\Models\Company;

class Edit extends Controller
{
    public function __invoke(Company $company, CompanyForm $form)
    {
        return ['form' => $form->edit($company)];
    }
}
