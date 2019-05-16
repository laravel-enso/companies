<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Forms\Builders\CompanyForm;

class Create extends Controller
{
    public function __invoke(CompanyForm $form)
    {
        return ['form' => $form->create()];
    }
}
