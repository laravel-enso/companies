<?php

namespace LaravelEnso\Companies\Http\Controllers\Company;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\Http\Requests\ValidateCompanyRequest;
use LaravelEnso\Companies\Models\Company;

class Store extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateCompanyRequest $request, Company $company)
    {
        $company->fill($request->validated());

        $this->authorize('store', $company);

        $company->save();

        return [
            'message' => __('The company was successfully created'),
            'redirect' => 'administration.companies.edit',
            'param' => ['company' => $company->id],
        ];
    }
}
