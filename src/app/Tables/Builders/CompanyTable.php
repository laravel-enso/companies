<?php

namespace LaravelEnso\Companies\app\Tables\Builders;

use Illuminate\Support\Facades\File;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Tables\app\Services\Table;

class CompanyTable extends Table
{
    const TemplatePath = __DIR__.'/../Templates/companies.json';

    public function query()
    {
        return Company::selectRaw('
            companies.*, companies.id as "dtRowId", people.name as mandatary
        ')->leftJoin('people', 'companies.mandatary_id', '=', 'people.id');
    }

    public function templatePath()
    {
        $file = config('enso.companies.tableTemplate');

        $templatePath = base_path($file);

        return $file && File::exists($templatePath)
            ? $templatePath
            : self::TemplatePath;
    }
}
