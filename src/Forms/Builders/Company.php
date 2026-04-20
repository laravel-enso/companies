<?php

namespace LaravelEnso\Companies\Forms\Builders;

use LaravelEnso\Companies\Enums\Status;
use LaravelEnso\Companies\Models\Company as Model;
use LaravelEnso\Forms\Services\Form;

class Company
{
    private const TemplatePath = __DIR__.'/../Templates/company.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = new Form($this->templatePath());
    }

    public function create()
    {
        return $this->form->readonly('mandatary')
            ->value('status', Status::Active->value)
            ->meta('mandatary', 'custom', false)
            ->meta('mandatary', 'placeholder', 'N/A')
            ->create();
    }

    public function edit(Model $company)
    {
        return $this->form
            ->value('mandatary', $company->mandatary()?->id)
            ->edit($company);
    }

    protected function templatePath(): string
    {
        return self::TemplatePath;
    }
}
