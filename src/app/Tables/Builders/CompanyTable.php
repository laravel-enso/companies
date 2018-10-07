<?php

namespace LaravelEnso\Companies\app\Tables\Builders;

use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\VueDatatable\app\Classes\Table;

class CompanyTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/companies.json';

    public function query()
    {
        return Company::select(\DB::raw(
                'companies.id as "dtRowId", companies.name, companies.email, companies.phone,
                companies.fax, companies.bank, companies.pays_vat, people.name as mandatary,
                companies.created_at'
            ))->leftJoin('people', 'companies.mandatary_id', '=', 'people.id');
    }
}
