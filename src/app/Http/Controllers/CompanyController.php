<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\Companies\app\Forms\Builders\CompanyForm;
use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyRequest;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function create(CompanyForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateCompanyRequest $request, Company $company)
    {
        tap($company)
            ->fill($request->all())
            ->save();

        return [
            'message' => __('The company was successfully created'),
            'redirect' => 'administration.companies.edit',
            'param' => ['company' => $company->id],
        ];
    }

    public function edit(Company $company, CompanyForm $form)
    {
        return ['form' => $form->edit($company)];
    }

    public function update(ValidateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());

        return ['message' => __('The company was successfully updated')];
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return [
            'message' => __('The company was successfully deleted'),
            'redirect' => 'administration.companies.index',
        ];
    }
}
