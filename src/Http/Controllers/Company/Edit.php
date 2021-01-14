<?php

namespace LaravelEnso\Companies\Http\Controllers\Company;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Forms\Builders\CompanyForm;
use LaravelEnso\Companies\Models\Company;

class Edit extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Company $company, CompanyForm $form)
    {
        $this->authorize('update', $company);

        return ['form' => $form->edit($company)];
    }
}
