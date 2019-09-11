<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use LaravelEnso\Forms\app\Services\Form;
use LaravelEnso\Companies\app\Models\Company;

class CompanyForm
{
    protected const TemplatePath = __DIR__.'/../Templates/company.json';

    protected $form;

    public function __construct()
    {
        $this->form = new Form(static::TemplatePath);
    }

    public function create()
    {
        return $this->form->readonly('mandatary')
            ->meta('mandatary', 'custom', false)
            ->meta('mandatary', 'placeholder', 'N/A')
            ->create();
    }

    public function edit(Company $company)
    {
        return $this->form
            ->value('mandatary', optional($company->mandatary())->id)
            ->edit($company);
    }
}
