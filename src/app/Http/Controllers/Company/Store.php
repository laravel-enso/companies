<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyRequest;
use LaravelEnso\Companies\app\Models\Company;

class Store extends Controller
{
    public function __invoke(ValidateCompanyRequest $request, Company $company)
    {
        $company->fill($request->validated())->save();

        return [
            'message' => __('The company was successfully created'),
            'redirect' => 'administration.companies.edit',
            'param' => ['company' => $company->id],
        ];
    }
}
