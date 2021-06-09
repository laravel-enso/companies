<?php

namespace LaravelEnso\Companies\Forms\Builders;

use LaravelEnso\Companies\Enums\Statuses;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Forms\Services\Form;

class CompanyForm
{
    protected const TemplatePath = __DIR__.'/../Templates/company.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = new Form(static::TemplatePath);
    }

    public function create()
    {
        return $this->form->readonly('mandatary')
            ->value('status', Statuses::Active)
            ->meta('mandatary', 'custom', false)
            ->meta('mandatary', 'placeholder', 'N/A')
            ->create();
    }

    public function edit(Company $company)
    {
        return $this->form
            ->value('mandatary', $company->mandatary()?->id)
            ->edit($company);
    }
}
