<?php

namespace LaravelEnso\Companies\app\Tables\Builders;

use LaravelEnso\Tables\app\Services\Table;
use LaravelEnso\Companies\app\Models\Company;

class CompanyTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/companies.json';

    public function query()
    {
        return Company::selectRaw('
            companies.id, companies.name, companies.fiscal_code, people.name as mandatary,
            companies.email, companies.phone, companies.fax, companies.bank, companies.pays_vat,
            companies.status, companies.status as statusValue, companies.is_tenant, companies.created_at
        ')->leftJoin('company_person', function ($join) {
            $join->on('companies.id', '=', 'company_person.company_id')
                ->where('company_person.is_mandatary', true);
        })->leftJoin('people', 'company_person.person_id', '=', 'people.id');
    }
}
