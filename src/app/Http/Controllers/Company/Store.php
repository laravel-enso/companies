<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyStore;

class Store extends Controller
{
    public function __invoke(ValidateCompanyStore $request, Company $company)
    {
        $company->fill($request->validated())->save();

        return [
            'message' => __('The company was successfully created'),
            'redirect' => 'administration.companies.edit',
            'param' => ['company' => $company->id],
        ];
    }
}
