<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\FormBuilder\app\Classes\Form;

class CompanyForm
{
    private const TemplatePath = __DIR__.'/../Templates/company.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Company $company)
    {
        return $this->form
            ->append('companyId', $company->id)
            ->edit($company);
    }
}
