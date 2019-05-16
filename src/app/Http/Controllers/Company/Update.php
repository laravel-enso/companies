<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyUpdate;

class Update extends Controller
{
    public function __invoke(ValidateCompanyUpdate $request, Company $company)
    {
        $company->update($request->validated());

        return ['message' => __('The company was successfully updated')];
    }
}
