<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use Illuminate\Support\Facades\File;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Forms\app\Services\Form;

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
        return $this->form->meta('mandatary_id', 'custom', false)
            ->meta('mandatary_id', 'placeholder', 'N/A')
            ->readonly('mandatary_id')
            ->create();
    }

    public function edit(Company $company)
    {
        return $this->form->edit($company);
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
