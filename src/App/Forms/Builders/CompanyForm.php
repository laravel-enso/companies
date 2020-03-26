<?php

namespace LaravelEnso\Companies\App\Forms\Builders;

use LaravelEnso\Companies\App\Enums\CompanyStatuses;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Forms\App\Services\Form;

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
            ->value('status', CompanyStatuses::Active)
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
