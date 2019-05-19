<?php

namespace LaravelEnso\Companies\app\Tables\Builders;

use Illuminate\Support\Facades\File;
use LaravelEnso\Tables\app\Services\Table;
use LaravelEnso\Companies\app\Models\Company;

class CompanyTable extends Table
{
    const TemplatePath = __DIR__.'/../Templates/companies.json';

    public function query()
    {
        return Company::selectRaw('
            companies.*, companies.id as "dtRowId", people.name as mandatary
        ')->leftJoin('company_person', function ($join) {
            $join->on('companies.id', '=', 'company_person.company_id')
                    ->where('company_person.is_mandatary', true);
        })->leftJoin('people', 'company_person.person_id', '=', 'people.id');
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
