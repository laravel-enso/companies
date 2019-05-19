<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use Illuminate\Support\Facades\File;
use LaravelEnso\Forms\app\Services\Form;
use LaravelEnso\Companies\app\Models\Company;

class CompanyForm
{
    private const TemplatePath = __DIR__.'/../Templates/company.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form($this->templatePath());
    }

    public function create()
    {
        return $this->form->meta('mandatary', 'custom', false)
            ->meta('mandatary', 'placeholder', 'N/A')
            ->readonly('mandatary')
            ->create();
    }

    public function edit(Company $company)
    {
        return $this->form
            ->value('mandatary', optional($company->mandatary())->id)
            ->edit($company);
    }

    private function templatePath()
    {
        $file = config('enso.companies.formTemplate');

        $templatePath = base_path($file);

        return $file && File::exists($templatePath)
            ? $templatePath
            : self::TemplatePath;
    }
}
