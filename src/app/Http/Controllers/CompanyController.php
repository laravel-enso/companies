<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
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

    public function store()
    {
        $request = app()->make($this->requestValidator());

        $company = Company::create($request->validated());

        return [
            'message' => __('The company was successfully created'),
            'redirect' => 'administration.companies.edit',
            'id' => $company->id,
        ];
    }

    public function edit(Company $company, CompanyForm $form)
    {
        return ['form' => $form->edit($company)];
    }

    public function update(Company $company)
    {
        $request = app()->make($this->requestValidator());

        $company->update($request->validated());

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

    private function requestValidator()
    {
        return class_exists(config('enso.companies.requestValidator'))
            ? config('enso.companies.requestValidator')
            : ValidateCompanyRequest::class;
    }
}
